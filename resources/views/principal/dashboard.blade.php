@extends('layouts.app')

@section('title', 'Dashboard Kepala Sekolah - AI Learning')
@section('page_header', 'Dashboard Kepala Sekolah')
@section('page_subtitle', 'Selamat datang kembali, ' . session('moodle_user.fullname'))

@section('content')
@if(isset($error))
<div class="modern-card" style="border-left:4px solid var(--danger);padding:2rem;text-align:center;">
    <p class="text-rose-600 font-bold">{{ $error }}</p>
</div>
@else

<div class="modern-card" style="border-left:4px solid var(--primary); margin-bottom:2rem; padding:1.25rem 2rem;">
    <div style="display:flex; justify-content:space-between; align-items:center;">
        <div>
            <p class="text-xs font-bold text-slate-500 uppercase">Sekolah</p>
            <h2 class="text-2xl font-bold text-slate-800 mt-1">{{ $school->school_name }}</h2>
        </div>
        <div style="text-align:right;">
            <p class="text-xs font-bold text-slate-500 uppercase">Jenjang</p>
            <span class="badge-{{ $school->jenjang == 'sd' ? 'primary' : ($school->jenjang == 'sma' ? 'success' : 'warning') }}" style="font-size:13px; margin-top:0.25rem; display:inline-block;">
                {{ strtoupper($school->jenjang ?? '-') }}
            </span>
        </div>
    </div>
</div>

<!-- Performance Index -->
<div class="stat-group" style="margin-bottom:2rem;">
    <div class="modern-card" onclick="window.location='/principal/student-mastery'" style="cursor:pointer; border-left:4px solid var(--primary);">
        <div class="text-xs font-bold text-slate-500 uppercase mb-1">Rata-rata Mastery</div>
        <div class="text-3xl font-bold text-slate-800">{{ $avgMastery }}</div>
        <p class="text-xs text-slate-500 mt-2">Skor rata-rata seluruh siswa</p>
    </div>
    <div class="modern-card" onclick="window.location='/principal/excellent-students'" style="cursor:pointer; border-left:4px solid var(--success);">
        <div class="text-xs font-bold text-slate-500 uppercase mb-1">Excellent Rate</div>
        <div class="text-3xl font-bold text-emerald-600">{{ $excellentRate }}%</div>
        <p class="text-xs text-slate-500 mt-2">{{ $excellentCount }} siswa di atas target ({{ $targetSchool }})</p>
    </div>
    <div class="modern-card" onclick="window.location='/principal/alert-students'" style="cursor:pointer; border-left:4px solid var(--danger);">
        <div class="text-xs font-bold text-slate-500 uppercase mb-1">Alert Rate</div>
        <div class="text-3xl font-bold text-rose-600">{{ $alertRate }}%</div>
        <p class="text-xs text-slate-500 mt-2">{{ $alertCount }} siswa di bawah KKM ({{ $kkmScore }})</p>
    </div>
    <div class="modern-card" style="border-left:4px solid #f59e0b;">
        <div class="text-xs font-bold text-slate-500 uppercase mb-1">Rata-rata Growth</div>
        <div class="text-3xl font-bold text-amber-600">{{ $avgGrowth }}%</div>
        <p class="text-xs text-slate-500 mt-2">Pertumbuhan dari {{ $totalStudents }} siswa</p>
    </div>
</div>

<div style="display:grid; grid-template-columns: 1fr 1fr; gap:2rem; margin-bottom:2rem;">
    <!-- Subject Heatmap -->
    <div class="modern-card">
        <h3 class="text-slate-800 font-bold mb-4">Subject Heatmap</h3>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Mata Pelajaran</th>
                        <th style="text-align:center;">Siswa</th>
                        <th style="text-align:center;">Rata-rata</th>
                        <th style="text-align:center;">Excellent</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($subjectStats as $ss)
                    <tr>
                        <td class="font-bold">{{ $ss['name'] }}</td>
                        <td style="text-align:center;">{{ $ss['students'] }}</td>
                        <td style="text-align:center;">
                            <span style="color:{{ $ss['avg_score'] >= $targetSchool ? '#059669' : ($ss['avg_score'] >= $kkmScore ? '#d97706' : '#dc2626') }}; font-weight:800;">
                                {{ $ss['avg_score'] }}
                            </span>
                        </td>
                        <td style="text-align:center;">
                            <div style="width:60px;height:8px;background:#e2e8f0;border-radius:4px;overflow:hidden;margin:0 auto;">
                                <div style="width:{{ $ss['excellent_rate'] }}%;height:100%;background:{{ $ss['excellent_rate'] >= 50 ? 'var(--success)' : 'var(--warning)' }};"></div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" style="text-align:center;padding:2rem;">Belum ada data.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Growth per Mapel Line Chart -->
    <div class="modern-card">
        <h3 class="text-slate-800 font-bold mb-4">Growth per Mapel</h3>
        <p class="text-xs text-slate-500 mb-4">Tren rata-rata nilai per mata pelajaran</p>
        <div style="position:relative; height:250px; width:100%;">
            <canvas id="trendChart"></canvas>
        </div>
    </div>
</div>

<!-- Matriks Komparatif Antar Kelas -->
<div class="modern-card">
    <h3 class="text-slate-800 font-bold mb-4">Matriks Komparatif Antar Kelas</h3>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Kelas</th>
                    <th style="text-align:center;">Jumlah Siswa</th>
                    <th style="text-align:center;">Rata-rata Skor</th>
                    <th style="text-align:center;">Growth</th>
                    <th style="text-align:center;">Excellent Rate</th>
                    <th style="text-align:center;">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($classMatrix as $cm)
                @php
                    $status = $cm['avg_score'] >= $targetSchool ? 'HEALTHY' : ($cm['avg_score'] >= $kkmScore ? 'WARNING' : 'CRITICAL');
                    $statusColor = $cm['avg_score'] >= $targetSchool ? 'var(--success)' : ($cm['avg_score'] >= $kkmScore ? '#f59e0b' : 'var(--danger)');
                @endphp
                <tr>
                    <td class="font-bold">{{ $cm['name'] }}</td>
                    <td style="text-align:center;">{{ $cm['students'] }}</td>
                    <td style="text-align:center; font-weight:800; color:{{ $statusColor }};">{{ $cm['avg_score'] }}</td>
                    <td style="text-align:center;" class="{{ $cm['growth'] >= 0 ? 'text-emerald-600' : 'text-rose-600' }} font-bold">{{ $cm['growth'] >= 0 ? '↑' : '↓' }} {{ number_format(abs($cm['growth']), 1) }}%</td>
                    <td style="text-align:center;">{{ $cm['excellent_rate'] }}%</td>
                    <td style="text-align:center;">
                        <span style="background:{{ $statusColor }}15; color:{{ $statusColor }}; padding:0.2rem 0.6rem; border-radius:9999px; font-size:10px; font-weight:700;">{{ $status }}</span>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align:center;padding:2rem;">Belum ada data kelas.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endif

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const trendLabels = {!! json_encode($trendLabels ?? []) !!};
    const trendDatasets = {!! json_encode($trendDatasets ?? []) !!};
    const subjectHasTrend = {!! json_encode($subjectHasTrend ?? false) !!};

    if (document.getElementById('trendChart')) {
        if (!trendLabels.length) {
            document.getElementById('trendChart').parentElement.innerHTML = '<div style="text-align:center;padding:3rem;color:#94a3b8;"><p class="font-bold">Data Belum Cukup</p><p class="text-xs mt-2">Minimal diperlukan 2 kali ujian per mapel untuk melihat pertumbuhan.</p></div>';
        } else {
            new Chart(document.getElementById('trendChart'), {
                type: 'line',
                data: {
                    labels: trendLabels,
                    datasets: trendDatasets.map(ds => ({
                        label: ds.label,
                        data: ds.data,
                        borderColor: ds.borderColor,
                        backgroundColor: ds.backgroundColor,
                        fill: true,
                        tension: 0.3,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        borderWidth: 2
                    }))
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 11 } } }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            title: { display: true, text: 'Nilai Rata-rata', font: { size: 11 } },
                            grid: { color: 'rgba(0,0,0,0.05)' }
                        },
                        x: {
                            title: { display: true, text: 'Quiz Ke-', font: { size: 11 } },
                            grid: { display: false }
                        }
                    }
                }
            });
        }
    }
</script>
@endsection