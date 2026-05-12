@extends('layouts.app')

@section('title', 'Profil Kompetensi Siswa - AI Learning')
@section('page_header', 'Halo, ' . ($user['fullname'] ?? 'Siswa'))
@section('school_badge', strtoupper($schoolName))
@section('page_subtitle', 'Analisis mendalam capaian kompetensi dan progres belajar Anda.')

@section('content')
<!-- New Top Stat Cards -->
<!-- Kalkulasi Cerdas Berdasarkan Peta Kompetensi -->
@php
    $targetSchool = $benchmark->target_school ?? 75;
    $kkmScore = $kkm->min_score ?? 70;

    $needsImprovementTopics = 0;
    $alertTopics = 0;

    $mapelScores = [];
    $mapelTopics = []; // mapel_code => [topik_name => score]

    foreach($masteryData as $topic => $data) {
        $topicScore = $data['score'];
        $hasData = ($data['total_questions'] ?? 0) > 0;
        if (!$hasData) continue;

        if ($topicScore < $kkmScore) $alertTopics++;

        $codeParts = explode('-', $data['topic_code'] ?? '');
        $mapelCode = $codeParts[0] ?? $topic;
        
        if (!isset($mapelScores[$mapelCode])) {
            $mapelScores[$mapelCode] = ['total' => 0, 'count' => 0];
            $mapelTopics[$mapelCode] = [];
        }
        $mapelScores[$mapelCode]['total'] += $topicScore;
        $mapelScores[$mapelCode]['count']++;
        $mapelTopics[$mapelCode][$topic] = $topicScore;
    }

    // Cari nama mapel
    $mapelNames = [];
    $mapelAvg = [];
    foreach ($mapelScores as $code => $m) {
        $mt = DB::table('ai_competencies')->where('topic_code', $code)->first();
        $mapelNames[$code] = $mt ? $mt->topic_name : $code;
        $mapelAvg[$code] = round($m['total'] / $m['count'], 1);
    }

    $excellentMapel = 0;
    foreach ($mapelScores as $code => $m) {
        $avgMapel = $m['total'] / $m['count'];
        if ($avgMapel >= $targetSchool) $excellentMapel++;
        if ($avgMapel < $kkmScore) $needsImprovementTopics++;
    }
@endphp

<div class="stat-group" style="margin-bottom: 2rem;">
    <div class="modern-card highlight-card" onclick="window.location='/student/excellent-scores'" style="cursor: pointer; border-left: 4px solid var(--success);">
        <div class="text-xs font-bold text-slate-500 uppercase mb-1">Capaian di Atas Target</div>
        <div class="text-3xl font-bold text-emerald-600">
            {{ $excellentMapel }} <span class="text-sm font-normal text-slate-400">Mapel</span>
        </div>
        <p class="text-xs text-slate-500 mt-2">Mata pelajaran dengan rata-rata di atas target sekolah ({{ $targetSchool }})</p>
    </div>
    <div class="modern-card highlight-card" onclick="window.location='/student/alert-scores'" style="cursor: pointer; border-left: 4px solid var(--danger);">
        <div class="text-xs font-bold text-slate-500 uppercase mb-1">Needs Improvement</div>
        <div class="text-3xl font-bold text-rose-600">
            {{ $needsImprovementTopics }} <span class="text-sm font-normal text-slate-400">Mapel</span>
        </div>
        <p class="text-xs text-slate-500 mt-2">Mata pelajaran dengan rata-rata di bawah KKM ({{ $kkmScore }})</p>
    </div>
    <div class="modern-card" onclick="window.location='/student/topic-alerts'" style="cursor: pointer; border-left: 4px solid #f59e0b;">
        <div class="text-xs font-bold text-slate-500 uppercase mb-1">Alert Topik Kritis</div>
        <div class="text-3xl font-bold text-amber-600">
            {{ $alertTopics }} <span class="text-sm font-normal text-slate-400">Topik</span>
        </div>
        <p class="text-xs text-slate-500 mt-2">Topik spesifik dengan nilai di bawah KKM ({{ $kkmScore }})</p>
    </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 2fr; gap: 2rem; margin-bottom: 2rem;">
    <!-- Spider Radar Chart Card & Table -->
    <div style="display: flex; flex-direction: column;">
        <div class="modern-card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                <h3 class="text-slate-800 font-bold">Peta Kompetensi (Radar)</h3>
                <select id="radarViewSelect" onchange="updateRadar()" style="padding:0.4rem 1rem;border-radius:10px;border:1px solid var(--border);background:var(--bg-card);color:var(--text-main);font-size:12px;min-width:160px;">
                    <option value="__all">Semua Mapel</option>
                    @foreach($mapelNames as $code => $name)
                        <option value="{{ $code }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div style="position: relative; height:300px; width:100%; display: flex; justify-content: center;">
                <canvas id="competencyRadar"></canvas>
            </div>
        </div>

        <!-- TABEL DIAGNOSTIK DATA MENTAH -->
        <div class="modern-card" style="margin-top: 1.5rem;">
            <h3 class="text-slate-800 font-bold mb-4">Tabel Analisis Peta Kompetensi</h3>
            <div class="table-wrapper">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="text-align: left;">
                            <th style="padding: 8px; font-size: 12px;">Topik Pelajaran</th>
                            <th style="text-align: center; padding: 8px; font-size: 12px;">Soal Dihadapi</th>
                            <th style="text-align: center; padding: 8px; font-size: 12px;">Jawaban Benar</th>
                            <th style="text-align: center; padding: 8px; font-size: 12px;">Skor</th>
                            <th style="padding: 8px; font-size: 12px;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($masteryData as $topic => $data)
                        <tr>
                            <td style="padding: 8px; font-size: 12px;" class="font-bold text-indigo-600">{{ $topic }}</td>
                            <td style="padding: 8px; text-align: center; font-size: 12px; color: var(--text-muted);">{{ round($data['total_questions']) }} Soal</td>
                            <td style="padding: 8px; text-align: center; font-size: 12px; color: var(--success); font-weight: bold;">{{ round($data['correct_answers'], 1) }} Benar</td>
                            <td style="padding: 8px; text-align: center;">
                                <div style="display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                                    <div style="width: 80px; height: 8px; background: #e2e8f0; border-radius: 4px; overflow: hidden;">
                                        <div style="width: {{ $data['score'] }}%; height: 100%; background: {{ $data['score'] >= 70 ? 'var(--success)' : ($data['score'] >= 50 ? 'var(--warning)' : 'var(--danger)') }};"></div>
                                    </div>
                                    <span class="font-bold text-[11px]">{{ number_format($data['score'], 1) }}</span>
                                </div>
                            </td>
                            <td style="padding: 8px;">
                                @if($data['score'] >= 70)
                                    <span class="badge-success" style="font-size: 10px;">Dikuasai</span>
                                @elseif($data['score'] >= 50)
                                    <span class="badge-warning" style="font-size: 10px;">Perlu Latihan</span>
                                @else
                                    <span style="background: rgba(239, 68, 68, 0.1); color: rgb(239, 68, 68); padding: 0.2rem 0.6rem; border-radius: 9999px; font-size: 10px; font-weight: 700;">Remedial</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 2rem; font-size: 12px;">Belum ada data nilai topik yang terdeteksi.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Right Side: Badges & Growth -->
    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
        <!-- Lencana Capaian -->
        <div class="modern-card">
            <h3 class="text-slate-800 font-bold mb-4">Lencana Capaian</h3>
            <div style="display: flex; gap: 1.5rem;">
                <div style="text-align: center; width: 100px;">
                    <div style="width: 60px; height: 60px; background: #fef3c7; border-radius: 50%; margin: 0 auto 0.5rem; display: flex; align-items: center; justify-content: center; color: #b45309;">
                        <i data-lucide="zap"></i>
                    </div>
                    <p class="text-[10px] font-bold">Fast Learner</p>
                    <p class="text-[9px] text-slate-500">Matematika</p>
                </div>
                <div style="text-align: center; width: 100px;">
                    <div style="width: 60px; height: 60px; background: #dcfce7; border-radius: 50%; margin: 0 auto 0.5rem; display: flex; align-items: center; justify-content: center; color: #15803d;">
                        <i data-lucide="target"></i>
                    </div>
                    <p class="text-[10px] font-bold">Sharp Shooter</p>
                    <p class="text-[9px] text-slate-500">Fisika</p>
                </div>
                <div style="text-align: center; width: 100px; opacity: 0.3;">
                    <div style="width: 60px; height: 60px; background: #f1f5f9; border-radius: 50%; margin: 0 auto 0.5rem; display: flex; align-items: center; justify-content: center; color: #64748b;">
                        <i data-lucide="trophy"></i>
                    </div>
                    <p class="text-[10px] font-bold">Growth King</p>
                    <p class="text-[9px] text-slate-500">Biologi</p>
                </div>
            </div>
        </div>

        <!-- Analisis Growth -->
        <div class="modern-card" onclick="window.location='/student/growth-details'" style="cursor: pointer; border-left: 4px solid var(--primary);">
            <h3 class="text-slate-800 font-bold mb-1">Analisis Growth</h3>
            <p class="text-[10px] text-slate-500 mb-4 uppercase font-bold">Klik untuk riwayat nilai lengkap</p>
            <div style="display: flex; flex-direction: column; gap: 1rem;">
                <div>
                    <div class="flex justify-between text-xs mb-1">
                        <span class="text-slate-500">Progres Keseluruhan (Semester ini)</span>
                        <span class="text-emerald-600 font-bold">↑ {{ $snapshot ? $snapshot->growth_percentage : 0 }}%</span>
                    </div>
                    <div class="progress-container"><div class="progress-fill" style="width: {{ $snapshot ? $snapshot->current_score : 0 }}%;"></div></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const mapelData = {!! json_encode($mapelAvg) !!};
    const mapelNames = {!! json_encode($mapelNames) !!};
    const mapelTopics = {!! json_encode($mapelTopics) !!};
    const allTopics = {!! json_encode(collect($masteryData)->mapWithKeys(function($d, $t) {
        return [$t => round($d['score'], 1)];
    })) !!};

    let radarChart = null;
    const ctx = document.getElementById('competencyRadar');

    function updateRadar() {
        const val = document.getElementById('radarViewSelect').value;
        let labels, scores;

        if (val === '__all') {
            // Tampilkan Mapel
            labels = Object.keys(mapelData).map(c => mapelNames[c] || c);
            scores = Object.values(mapelData);
        } else {
            // Tampilkan topik-topik dalam mapel tertentu
            const topics = mapelTopics[val] || {};
            labels = Object.keys(topics);
            scores = Object.values(topics);
        }

        if (radarChart) radarChart.destroy();

        radarChart = new Chart(ctx, {
            type: 'radar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Skor',
                    data: scores,
                    fill: true,
                    backgroundColor: 'rgba(79, 70, 229, 0.2)',
                    borderColor: 'rgb(79, 70, 229)',
                    pointBackgroundColor: 'rgb(79, 70, 229)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(79, 70, 229)'
                }]
            },
            options: {
                elements: { line: { borderWidth: 3 } },
                plugins: { legend: { display: false } },
                scales: {
                    r: {
                        angleLines: { display: true },
                        suggestedMin: 0,
                        suggestedMax: 100
                    }
                }
            }
        });
    }

    updateRadar();
</script>
@endsection
