@extends('layouts.smart_school')

@section('title', 'Analisis Performa (Smart Mapping)')
@section('page_header', 'Smart Mapping')
@section('page_subtitle', 'Analisis performa akademik dan pemetaan ATP')
@section('breadcrumb')
<a href="{{ url('/demo/smart-school/kepsek') }}">Kepsek</a> / <a href="{{ url('/demo/smart-school/kepsek/smart-mapping') }}">Monitoring</a> / <span>Smart Mapping</span>
@endsection

@section('content')

<!-- Grafik Rata-rata Nilai per Mapel -->
<div class="modern-card" style="margin-bottom:2rem;">
    <h3 style="font-size:1rem;font-weight:700;margin-bottom:1rem;">Rata-rata Nilai per Mata Pelajaran</h3>
    <canvas id="mapelChart" height="220"></canvas>
</div>

<!-- Topik dengan Tingkat Ketuntasan Rendah -->
<div class="modern-card" style="margin-bottom:2rem;">
    <h3 style="font-size:1rem;font-weight:700;margin-bottom:1rem;">Topik dengan Tingkat Ketuntasan Rendah</h3>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr><th>No</th><th>Mapel</th><th>Topik</th><th>Jml Siswa Tidak Tuntas</th><th>Rata-rata Nilai</th><th>Status</th></tr>
            </thead>
            <tbody>
                @php
                    $topik = [
                        ['Matematika', 'Fungsi Trigonometri', 18, 58],
                        ['Bahasa Inggris', 'Passive Voice', 14, 62],
                        ['IPA', 'Gelombang Elektromagnetik', 12, 55],
                        ['IPS', 'Perekonomian Global', 9, 68],
                        ['Matematika', 'Limit Fungsi', 20, 45],
                        ['PKN', 'Hak Asasi Manusia', 7, 72],
                    ];
                    $sts = function($v) {
                        if ($v < 60) return ['Alert', 'badge-red'];
                        if ($v < 70) return ['Perhatian', 'badge-yellow'];
                        return ['Aman', 'badge-green'];
                    };
                @endphp
                @foreach($topik as $i => $t)
                    @php($s = $sts($t[3]))
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td style="font-weight:600;">{{ $t[0] }}</td>
                        <td>{{ $t[1] }}</td>
                        <td>{{ $t[2] }} siswa</td>
                        <td style="font-weight:700;color:{{ $t[3] < 70 ? 'var(--danger)' : 'var(--success)' }};">{{ $t[3] }}</td>
                        <td><span class="{{ $s[1] }}">{{ $s[0] }}</span></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Identifikasi ATP -->
<div>
    <h3 style="font-size:1rem;font-weight:700;margin-bottom:1rem;">Identifikasi ATP Bermasalah</h3>
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;">
        @php
            $atps = [
                ['Matematika', 'Menganalisis fungsi trigonometri', 45, 'Siswa kesulitan memahami grafik fungsi'],
                ['Bahasa Inggris', 'Menyusun kalimat pasif', 55, 'Kurang latihan konversi tenses'],
                ['IPA', 'Memahami spektrum gelombang', 50, 'Minim alat peraga praktikum'],
                ['IPS', 'Menganalisis perdagangan internasional', 62, 'Data ekonomi terlalu abstrak'],
                ['PKN', 'Menerapkan HAM dalam kehidupan', 70, 'Kurang contoh kasus kontekstual'],
                ['SBK', 'Mengapresiasi karya seni rupa', 75, 'Tidak ada masalah signifikan'],
            ];
        @endphp
        @foreach($atps as $a)
        <div class="modern-card" style="border-left:4px solid {{ $a[2] < 60 ? 'var(--danger)' : ($a[2] < 70 ? 'var(--warning)' : 'var(--success)') }};">
            <div style="display:flex;justify-content:space-between;align-items:start;margin-bottom:0.75rem;">
                <span class="badge-{{ $a[2] < 60 ? 'red' : ($a[2] < 70 ? 'yellow' : 'green') }}" style="font-size:0.65rem;">{{ $a[2] < 60 ? 'Kritis' : ($a[2] < 70 ? 'Waspada' : 'Baik') }}</span>
                <span style="font-size:0.75rem;font-weight:700;color:var(--text-sub);">{{ $a[2] }}%</span>
            </div>
            <div style="font-size:0.75rem;font-weight:700;color:var(--text-sub);margin-bottom:0.25rem;">{{ $a[0] }}</div>
            <div style="font-weight:600;font-size:0.85rem;margin-bottom:0.5rem;">{{ $a[1] }}</div>
            <div style="font-size:0.75rem;color:var(--text-sub);">{{ $a[3] }}</div>
        </div>
        @endforeach
    </div>
</div>

@endsection

@section('scripts')
<script>
new Chart(document.getElementById('mapelChart').getContext('2d'), {
    type: 'bar',
    data: {
        labels: ['Matematika', 'B. Indonesia', 'B. Inggris', 'IPA', 'IPS', 'PKN', 'Agama', 'SBK'],
        datasets: [{
            label: 'Rata-rata Nilai',
            data: [58, 82, 62, 55, 68, 72, 85, 78],
            backgroundColor: ['#f43f5e','#22c55e','#eab308','#ef4444','#d97706','#059669','#06b6d4','#8b5cf6'],
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
