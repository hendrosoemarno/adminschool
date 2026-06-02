@extends('layouts.smart_school')

@section('title', 'Dashboard Guru - Smart School')
@section('page_header', 'Dashboard Guru')
@section('page_subtitle', 'Selamat datang, Bapak/Ibu Guru — kelola aktivitas pembelajaran Anda di sini.')
@section('breadcrumb')
<a href="{{ url('/demo/smart-school/guru') }}">Guru</a> / <span>Dashboard</span>
@endsection

@section('styles')
<style>
    .action-grid { display:grid; grid-template-columns:1fr 1fr 1fr; gap:1.25rem; margin-bottom:2rem; }
    .action-card { background:var(--bg-card); border-radius:24px; padding:1.75rem 1.5rem; border:1px solid var(--border); cursor:pointer; text-decoration:none; color:inherit; transition:all 0.3s ease; display:flex; align-items:center; gap:1.25rem; }
    .action-card:hover { transform:translateY(-4px); box-shadow:0 20px 25px -5px rgba(0,0,0,0.05); border-color:var(--primary); }
    .action-icon { width:48px; height:48px; border-radius:16px; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
    .action-info h4 { font-size:0.95rem; font-weight:700; margin-bottom:0.2rem; }
    .action-info p { font-size:0.75rem; color:var(--text-sub); margin:0; }
    .progress-bar { height:8px; border-radius:9999px; background:var(--border); margin-top:0.4rem; overflow:hidden; }
    .progress-bar div { height:100%; border-radius:9999px; transition:width 0.8s ease; }
    .section-title { font-size:1rem; font-weight:700; margin-bottom:1rem; display:flex; align-items:center; gap:0.5rem; }
    @media (max-width:1024px) { .action-grid { grid-template-columns:1fr 1fr; } }
    @media (max-width:640px) { .action-grid { grid-template-columns:1fr; } }
</style>
@endsection

@section('content')
<div class="action-grid">
    <a href="#" class="action-card" onclick="alert('Demo: fitur Input Jurnal akan dikembangkan');return false;">
        <div class="action-icon" style="background:#4f46e515;color:var(--primary);"><i data-lucide="book" style="width:24px;"></i></div>
        <div class="action-info">
            <h4>Input Jurnal</h4>
            <p>Catat jurnal harian pembelajaran</p>
        </div>
    </a>
    <a href="#" class="action-card" onclick="alert('Demo: fitur Input Nilai akan dikembangkan');return false;">
        <div class="action-icon" style="background:#05966915;color:var(--success);"><i data-lucide="clipboard-list" style="width:24px;"></i></div>
        <div class="action-info">
            <h4>Input Nilai</h4>
            <p>Input asesmen & nilai siswa</p>
        </div>
    </a>
    <a href="#" class="action-card" onclick="alert('Demo: fitur Data Remedial akan dikembangkan');return false;">
        <div class="action-icon" style="background:#d9770615;color:var(--warning);"><i data-lucide="alert-triangle" style="width:24px;"></i></div>
        <div class="action-info">
            <h4>Data Remedial</h4>
            <p>Kelola remedial & tindak lanjut</p>
        </div>
    </a>
    <a href="#" class="action-card" onclick="alert('Demo: fitur Cetak Rapor akan dikembangkan');return false;">
        <div class="action-icon" style="background:#dc262615;color:var(--danger);"><i data-lucide="file-text" style="width:24px;"></i></div>
        <div class="action-info">
            <h4>Cetak Rapor</h4>
            <p>Cetak rapor & narasi siswa</p>
        </div>
    </a>
    <a href="#" class="action-card" onclick="alert('Demo: fitur Presensi akan dikembangkan');return false;">
        <div class="action-icon" style="background:#6366f115;color:#6366f1;"><i data-lucide="users" style="width:24px;"></i></div>
        <div class="action-info">
            <h4>Presensi</h4>
            <p>Catat kehadiran siswa</p>
        </div>
    </a>
    <a href="#" class="action-card" onclick="alert('Demo: fitur Modul Ajar akan dikembangkan');return false;">
        <div class="action-icon" style="background:#8b5cf615;color:#8b5cf6;"><i data-lucide="book-open" style="width:24px;"></i></div>
        <div class="action-info">
            <h4>Modul Ajar</h4>
            <p>Buat & kelola modul ajar</p>
        </div>
    </a>
</div>

<div style="display:grid; grid-template-columns:2fr 1fr; gap:1.5rem;">
    <div class="modern-card">
        <div class="section-title"><i data-lucide="calendar" style="width:18px;color:var(--primary);"></i> Jadwal Mengajar Hari Ini</div>
        <div class="table-wrapper">
            <table>
                <thead><tr><th>Kelas</th><th>Mapel</th><th>Jam</th></tr></thead>
                <tbody>
                    <tr><td>XII IPA 1</td><td>Matematika Wajib</td><td>07:30 – 09:00</td></tr>
                    <tr><td>XII IPA 2</td><td>Matematika Wajib</td><td>09:15 – 10:45</td></tr>
                    <tr><td>XI IPA 1</td><td>Matematika Peminatan</td><td>11:00 – 12:30</td></tr>
                    <tr><td>X IPA 1</td><td>Matematika Dasar</td><td>13:00 – 14:30</td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modern-card">
        <div class="section-title"><i data-lucide="trending-up" style="width:18px;color:var(--primary);"></i> Progress Administrasi</div>
        <div style="display:flex;flex-direction:column;gap:1.25rem;">
            <div>
                <div style="display:flex;justify-content:space-between;font-size:0.8rem;font-weight:600;"><span>Modul Ajar</span><span>80%</span></div>
                <div class="progress-bar"><div style="width:80%;background:var(--primary);"></div></div>
            </div>
            <div>
                <div style="display:flex;justify-content:space-between;font-size:0.8rem;font-weight:600;"><span>Jurnal</span><span>60%</span></div>
                <div class="progress-bar"><div style="width:60%;background:var(--warning);"></div></div>
            </div>
            <div>
                <div style="display:flex;justify-content:space-between;font-size:0.8rem;font-weight:600;"><span>Nilai</span><span>90%</span></div>
                <div class="progress-bar"><div style="width:90%;background:var(--success);"></div></div>
            </div>
            <div>
                <div style="display:flex;justify-content:space-between;font-size:0.8rem;font-weight:600;"><span>Rapor</span><span>50%</span></div>
                <div class="progress-bar"><div style="width:50%;background:var(--danger);"></div></div>
            </div>
        </div>
    </div>
</div>
@endsection
