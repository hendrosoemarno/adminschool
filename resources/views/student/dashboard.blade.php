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
    
    $excellentTopics = 0;
    $needsImprovementTopics = 0;
    $remedialTopics = 0;
    
    foreach($masteryData as $topic => $data) {
        $topicScore = $data['score'];
        if ($topicScore >= $targetSchool) $excellentTopics++;
        if ($topicScore < $kkmScore) $needsImprovementTopics++;
        if ($topicScore < 50) $remedialTopics++;
    }
@endphp

<div class="stat-group" style="margin-bottom: 2rem;">
    <div class="modern-card highlight-card" onclick="window.location='/student/excellent-scores'" style="cursor: pointer; border-left: 4px solid var(--success);">
        <div class="text-xs font-bold text-slate-500 uppercase mb-1">Capaian di Atas Target</div>
        <div class="text-3xl font-bold text-emerald-600">
            {{ $excellentTopics }} <span class="text-sm font-normal text-slate-400">Topik</span>
        </div>
        <p class="text-xs text-slate-500 mt-2">Nilai topik di atas target sekolah ({{ $targetSchool }})</p>
    </div>
    <div class="modern-card highlight-card" onclick="window.location='/student/alert-scores'" style="cursor: pointer; border-left: 4px solid var(--danger);">
        <div class="text-xs font-bold text-slate-500 uppercase mb-1">Needs Improvement</div>
        <div class="text-3xl font-bold text-rose-600">
            {{ $needsImprovementTopics }} <span class="text-sm font-normal text-slate-400">Topik</span>
        </div>
        <p class="text-xs text-slate-500 mt-2">Topik ujian di bawah KKM ({{ $kkmScore }})</p>
    </div>
    <div class="modern-card" onclick="window.location='/student/topic-alerts'" style="cursor: pointer; border-left: 4px solid #f59e0b;">
        <div class="text-xs font-bold text-slate-500 uppercase mb-1">Alert Topik Kritis</div>
        <div class="text-3xl font-bold text-amber-600">
            {{ $remedialTopics }} <span class="text-sm font-normal text-slate-400">Topik</span>
        </div>
        <p class="text-xs text-slate-500 mt-2">Topik spesifik butuh perbaikan segera (Remedial)</p>
    </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 2fr; gap: 2rem; margin-bottom: 2rem;">
    <!-- Spider Radar Chart Card & Table -->
    <div style="display: flex; flex-direction: column;">
        <div class="modern-card">
            <h3 class="text-slate-800 font-bold mb-4">Peta Kompetensi (Radar)</h3>
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
    const masteryDataRaw = {!! json_encode($masteryData) !!};
    const labels = Object.keys(masteryDataRaw);
    const scores = Object.values(masteryDataRaw).map(item => item.score);

    const ctx = document.getElementById('competencyRadar');
    new Chart(ctx, {
        type: 'radar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Skor Kompetensi',
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
</script>
@endsection
