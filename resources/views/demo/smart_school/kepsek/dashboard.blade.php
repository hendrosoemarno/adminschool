@extends('layouts.smart_school')

@section('title', 'Dashboard Supervisi Kepala Sekolah')
@section('page_header', 'Dashboard Supervisi')
@section('page_subtitle', 'Pantau kinerja guru dan kepatuhan secara real-time')
@section('breadcrumb')
<a href="{{ url('/demo/smart-school/kepsek') }}">Kepsek</a> / <span>Dashboard Supervisi</span>
@endsection

@section('content')

<!-- Stat Cards -->
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:2rem;">
    <div class="modern-card" style="display:flex;align-items:center;gap:1rem;">
        <div style="width:50px;height:50px;border-radius:16px;background:var(--primary);color:#fff;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><i data-lucide="users" style="width:24px;"></i></div>
        <div><div style="font-size:0.7rem;color:var(--text-sub);font-weight:600;">Jumlah Guru</div><div style="font-size:1.75rem;font-weight:800;margin-top:0.15rem;">12</div></div>
    </div>
    <div class="modern-card" style="display:flex;align-items:center;gap:1rem;">
        <div style="width:50px;height:50px;border-radius:16px;background:var(--success);color:#fff;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><i data-lucide="check-circle" style="width:24px;"></i></div>
        <div><div style="font-size:0.7rem;color:var(--text-sub);font-weight:600;">Rata-rata Kepatuhan</div><div style="font-size:1.75rem;font-weight:800;margin-top:0.15rem;">78%</div></div>
    </div>
    <div class="modern-card" style="display:flex;align-items:center;gap:1rem;">
        <div style="width:50px;height:50px;border-radius:16px;background:var(--warning);color:#fff;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><i data-lucide="book" style="width:24px;"></i></div>
        <div><div style="font-size:0.7rem;color:var(--text-sub);font-weight:600;">Jurnal Hari Ini</div><div style="font-size:1.75rem;font-weight:800;margin-top:0.15rem;">8/12</div></div>
    </div>
    <div class="modern-card" style="display:flex;align-items:center;gap:1rem;">
        <div style="width:50px;height:50px;border-radius:16px;background:#8b5cf6;color:#fff;display:flex;align-items:center;justify-content:center;flex-shrink:0;"><i data-lucide="file-text" style="width:24px;"></i></div>
        <div><div style="font-size:0.7rem;color:var(--text-sub);font-weight:600;">Rapor Selesai</div><div style="font-size:1.75rem;font-weight:800;margin-top:0.15rem;">65%</div></div>
    </div>
</div>

<!-- Ringkasan Kepatuhan Guru -->
<div class="modern-card" style="margin-bottom:2rem;">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.25rem;">
        <h3 style="font-size:1rem;font-weight:700;">Ringkasan Kepatuhan Guru</h3>
        <span class="badge-green">Update: Hari ini</span>
    </div>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr><th>No</th><th>Nama Guru</th><th>Progress Modul</th><th>Progress Jurnal</th><th>Progress Nilai</th><th>Status</th></tr>
            </thead>
            <tbody>
                @php
                    $gurus = [
                        ['Dewi Sartika', 95, 100, 88],
                        ['Ahmad Fauzi', 72, 65, 45],
                        ['Siti Rahmawati', 88, 90, 92],
                        ['Bambang Supriyadi', 40, 55, 30],
                        ['Rina Marlina', 100, 95, 78],
                        ['Hendra Gunawan', 65, 50, 60],
                        ['Fitriani Nur', 92, 85, 95],
                        ['Agus Salim', 48, 40, 35],
                    ];
                    $status = function($modul, $jurnal, $nilai) {
                        $avg = ($modul + $jurnal + $nilai) / 3;
                        if ($avg > 90) return ['Hijau', 'badge-green'];
                        if ($avg >= 50) return ['Kuning', 'badge-yellow'];
                        return ['Merah', 'badge-red'];
                    };
                @endphp
                @foreach($gurus as $i => $g)
                    @php($s = $status($g[1], $g[2], $g[3]))
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td style="font-weight:600;">{{ $g[0] }}</td>
                        <td>
                            <div style="display:flex;align-items:center;gap:0.5rem;">
                                <div style="flex:1;height:6px;background:var(--border);border-radius:9999px;overflow:hidden;">
                                    <div style="width:{{ $g[1] }}%;height:100%;background:var(--primary);border-radius:9999px;"></div>
                                </div>
                                <span style="font-size:0.75rem;font-weight:600;">{{ $g[1] }}%</span>
                            </div>
                        </td>
                        <td>
                            <div style="display:flex;align-items:center;gap:0.5rem;">
                                <div style="flex:1;height:6px;background:var(--border);border-radius:9999px;overflow:hidden;">
                                    <div style="width:{{ $g[2] }}%;height:100%;background:var(--success);border-radius:9999px;"></div>
                                </div>
                                <span style="font-size:0.75rem;font-weight:600;">{{ $g[2] }}%</span>
                            </div>
                        </td>
                        <td>
                            <div style="display:flex;align-items:center;gap:0.5rem;">
                                <div style="flex:1;height:6px;background:var(--border);border-radius:9999px;overflow:hidden;">
                                    <div style="width:{{ $g[3] }}%;height:100%;background:var(--warning);border-radius:9999px;"></div>
                                </div>
                                <span style="font-size:0.75rem;font-weight:600;">{{ $g[3] }}%</span>
                            </div>
                        </td>
                        <td><span class="{{ $s[1] }}">{{ $s[0] }}</span></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Grafik Kehadiran Siswa + Statistik Cepat -->
<div style="display:grid;grid-template-columns:2fr 1fr;gap:1.5rem;margin-bottom:2rem;">
    <div class="modern-card">
        <h3 style="font-size:1rem;font-weight:700;margin-bottom:1rem;">Grafik Kehadiran Siswa Hari Ini</h3>
        <canvas id="attendanceChart" height="200"></canvas>
    </div>
    <div>
        <div class="modern-card" style="margin-bottom:1rem;">
            <div style="font-size:0.7rem;color:var(--text-sub);font-weight:600;">Upload Rapor</div>
            <div style="font-size:1.5rem;font-weight:800;margin:0.25rem 0 0.5rem;">65%</div>
            <div style="height:6px;background:var(--border);border-radius:9999px;overflow:hidden;">
                <div style="width:65%;height:100%;background:var(--primary);border-radius:9999px;"></div>
            </div>
        </div>
        <div class="modern-card" style="margin-bottom:1rem;">
            <div style="font-size:0.7rem;color:var(--text-sub);font-weight:600;">Rata-rata Nilai Kelas</div>
            <div style="font-size:1.5rem;font-weight:800;margin:0.25rem 0 0.5rem;">82.4</div>
            <div style="font-size:0.75rem;color:var(--success);font-weight:600;">&uarr; 3.2 dari bulan lalu</div>
        </div>
        <div class="modern-card">
            <div style="font-size:0.7rem;color:var(--text-sub);font-weight:600;">Ketuntasan Belajar</div>
            <div style="font-size:1.5rem;font-weight:800;margin:0.25rem 0 0.5rem;">78%</div>
            <div style="height:6px;background:var(--border);border-radius:9999px;overflow:hidden;">
                <div style="width:78%;height:100%;background:var(--success);border-radius:9999px;"></div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
var ctx = document.getElementById('attendanceChart').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['12A', '12B', '12C', '11A', '11B', '11C', '10A', '10B'],
        datasets: [{
            label: 'Kehadiran (%)',
            data: [95, 88, 92, 85, 90, 78, 96, 82],
            backgroundColor: ['#4f46e5','#059669','#d97706','#8b5cf6','#06b6d4','#f43f5e','#22c55e','#eab308'],
            borderRadius: 6
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, max: 100, grid: { color: 'var(--border)' } },
            x: { grid: { display: false } }
        }
    }
});
try { lucide.createIcons(); } catch(e) {}
</script>
@endsection
