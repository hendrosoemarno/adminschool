@extends('layouts.smart_school')

@section('title', 'Export Laporan Sekolah')
@section('page_header', 'Export Laporan')
@section('page_subtitle', 'Unduh laporan dalam format Excel atau PDF')
@section('breadcrumb')
<a href="{{ url('/demo/smart-school/kepsek') }}">Kepsek</a> / <a href="{{ url('/demo/smart-school/kepsek/export') }}">Dokumen</a> / <span>Export Laporan</span>
@endsection

@section('content')

<!-- Report Type Cards -->
<div style="display:grid;grid-template-columns:repeat(2,1fr);gap:1.5rem;margin-bottom:2rem;">
    <!-- Laporan Bulanan -->
    <div class="modern-card">
        <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:1rem;">
            <div style="width:42px;height:42px;border-radius:14px;background:var(--primary);color:#fff;display:flex;align-items:center;justify-content:center;"><i data-lucide="calendar" style="width:20px;"></i></div>
            <div><div style="font-weight:700;">Laporan Bulanan</div><div style="font-size:0.75rem;color:var(--text-sub);">Rekap aktivitas sekolah per bulan</div></div>
        </div>
        <div style="display:flex;gap:0.75rem;margin-bottom:1rem;flex-wrap:wrap;">
            <select style="flex:1;min-width:120px;padding:0.55rem 0.75rem;border-radius:10px;border:1px solid var(--border);background:var(--bg-card);color:var(--text-main);font-size:0.85rem;">
                <option>Januari</option><option>Februari</option><option>Maret</option><option>April</option><option>Mei</option><option>Juni</option><option>Juli</option><option>Agustus</option><option>September</option><option>Oktober</option><option>November</option><option>Desember</option>
            </select>
            <select style="flex:1;min-width:120px;padding:0.55rem 0.75rem;border-radius:10px;border:1px solid var(--border);background:var(--bg-card);color:var(--text-main);font-size:0.85rem;">
                <option>2025</option><option selected>2026</option><option>2027</option>
            </select>
        </div>
        <div style="display:flex;gap:0.75rem;">
            <button class="btn-success" onclick="alert('Demo: Export Excel Laporan Bulanan')"><i data-lucide="file-spreadsheet" style="width:16px;"></i> Export Excel</button>
            <button class="btn-indigo" onclick="alert('Demo: Export PDF Laporan Bulanan')"><i data-lucide="file" style="width:16px;"></i> Export PDF</button>
        </div>
    </div>

    <!-- Laporan Semester -->
    <div class="modern-card">
        <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:1rem;">
            <div style="width:42px;height:42px;border-radius:14px;background:var(--success);color:#fff;display:flex;align-items:center;justify-content:center;"><i data-lucide="layers" style="width:20px;"></i></div>
            <div><div style="font-weight:700;">Laporan Semester</div><div style="font-size:0.75rem;color:var(--text-sub);">Rekap akademik per semester</div></div>
        </div>
        <div style="display:flex;gap:0.75rem;margin-bottom:1rem;flex-wrap:wrap;">
            <select style="flex:1;min-width:120px;padding:0.55rem 0.75rem;border-radius:10px;border:1px solid var(--border);background:var(--bg-card);color:var(--text-main);font-size:0.85rem;">
                <option>Semester 1 (Ganjil)</option><option>Semester 2 (Genap)</option>
            </select>
            <select style="flex:1;min-width:120px;padding:0.55rem 0.75rem;border-radius:10px;border:1px solid var(--border);background:var(--bg-card);color:var(--text-main);font-size:0.85rem;">
                <option>2024/2025</option><option selected>2025/2026</option>
            </select>
        </div>
        <div style="display:flex;gap:0.75rem;">
            <button class="btn-success" onclick="alert('Demo: Export Excel Laporan Semester')"><i data-lucide="file-spreadsheet" style="width:16px;"></i> Export Excel</button>
            <button class="btn-indigo" onclick="alert('Demo: Export PDF Laporan Semester')"><i data-lucide="file" style="width:16px;"></i> Export PDF</button>
        </div>
    </div>

    <!-- Rekapitulasi Presensi -->
    <div class="modern-card">
        <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:1rem;">
            <div style="width:42px;height:42px;border-radius:14px;background:var(--warning);color:#fff;display:flex;align-items:center;justify-content:center;"><i data-lucide="clipboard-check" style="width:20px;"></i></div>
            <div><div style="font-weight:700;">Rekapitulasi Presensi</div><div style="font-size:0.75rem;color:var(--text-sub);">Data kehadiran siswa rentang tanggal</div></div>
        </div>
        <div style="display:flex;gap:0.75rem;margin-bottom:1rem;flex-wrap:wrap;">
            <input type="date" value="2026-05-01" style="flex:1;min-width:120px;padding:0.55rem 0.75rem;border-radius:10px;border:1px solid var(--border);background:var(--bg-card);color:var(--text-main);font-size:0.85rem;">
            <input type="date" value="2026-05-27" style="flex:1;min-width:120px;padding:0.55rem 0.75rem;border-radius:10px;border:1px solid var(--border);background:var(--bg-card);color:var(--text-main);font-size:0.85rem;">
        </div>
        <div style="display:flex;gap:0.75rem;">
            <button class="btn-success" onclick="alert('Demo: Export Excel Rekap Presensi')"><i data-lucide="file-spreadsheet" style="width:16px;"></i> Export Excel</button>
            <button class="btn-indigo" onclick="alert('Demo: Export PDF Rekap Presensi')"><i data-lucide="file" style="width:16px;"></i> Export PDF</button>
        </div>
    </div>

    <!-- Rekapitulasi Nilai -->
    <div class="modern-card">
        <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:1rem;">
            <div style="width:42px;height:42px;border-radius:14px;background:#8b5cf6;color:#fff;display:flex;align-items:center;justify-content:center;"><i data-lucide="bar-chart-3" style="width:20px;"></i></div>
            <div><div style="font-weight:700;">Rekapitulasi Nilai</div><div style="font-size:0.75rem;color:var(--text-sub);">Nilai siswa per kelas dan semester</div></div>
        </div>
        <div style="display:flex;gap:0.75rem;margin-bottom:1rem;flex-wrap:wrap;">
            <select style="flex:1;min-width:120px;padding:0.55rem 0.75rem;border-radius:10px;border:1px solid var(--border);background:var(--bg-card);color:var(--text-main);font-size:0.85rem;">
                <option>10A</option><option>10B</option><option>11A</option><option>11B</option><option>12A</option><option selected>12B</option><option>12C</option>
            </select>
            <select style="flex:1;min-width:120px;padding:0.55rem 0.75rem;border-radius:10px;border:1px solid var(--border);background:var(--bg-card);color:var(--text-main);font-size:0.85rem;">
                <option>Semester 1 (Ganjil)</option><option>Semester 2 (Genap)</option>
            </select>
        </div>
        <div style="display:flex;gap:0.75rem;">
            <button class="btn-success" onclick="alert('Demo: Export Excel Rekap Nilai')"><i data-lucide="file-spreadsheet" style="width:16px;"></i> Export Excel</button>
            <button class="btn-indigo" onclick="alert('Demo: Export PDF Rekap Nilai')"><i data-lucide="file" style="width:16px;"></i> Export PDF</button>
        </div>
    </div>
</div>

<!-- History Table -->
<div class="modern-card">
    <h3 style="font-size:1rem;font-weight:700;margin-bottom:1rem;">Riwayat Export</h3>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr><th>Tanggal</th><th>Jenis Laporan</th><th>Format</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @php
                    $history = [
                        ['2026-05-25 14:30', 'Laporan Bulanan - Mei 2026', 'Excel', 'Laporan_Bulanan_Mei_2026.xlsx'],
                        ['2026-05-20 09:15', 'Rekapitulasi Presensi', 'PDF', 'Rekap_Presensi_2026-05.pdf'],
                        ['2026-05-18 16:45', 'Laporan Semester - Genap 2025/2026', 'Excel', 'Laporan_Semester_Genap_2025_2026.xlsx'],
                        ['2026-05-10 11:00', 'Rekapitulasi Nilai - 12B', 'PDF', 'Rekap_Nilai_12B_2026.pdf'],
                    ];
                @endphp
                @foreach($history as $h)
                <tr>
                    <td style="font-size:0.8rem;">{{ $h[0] }}</td>
                    <td style="font-weight:600;">{{ $h[1] }}</td>
                    <td><span class="badge-{{ $h[2] === 'Excel' ? 'green' : 'yellow' }}">{{ $h[2] }}</span></td>
                    <td><button class="btn-outline-sm" onclick="alert('Demo: Download {{ $h[3] }}')"><i data-lucide="download" style="width:14px;"></i> Download</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('scripts')
<script>try { lucide.createIcons(); } catch(e) {}</script>
@endsection
