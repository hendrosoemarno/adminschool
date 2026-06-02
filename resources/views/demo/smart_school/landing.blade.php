@extends('layouts.smart_school')
@section('title', 'Smart School - Demo')
@section('page_header', 'Smart School')
@section('page_subtitle', 'Pilih peran untuk menjelajahi simulasi dashboard.')
@section('breadcrumb', '<span>Pilih Role</span>')
@section('content')
<style>
    .role-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:2rem; margin-top:2rem; }
    .role-card { background:var(--bg-card); border-radius:24px; padding:2.5rem 2rem; text-align:center; border:2px solid var(--border); cursor:pointer; text-decoration:none; color:inherit; transition:all 0.3s ease; display:block; }
    .role-card:hover { transform:translateY(-6px); box-shadow:0 25px 50px -12px rgba(0,0,0,0.15); border-color:var(--primary); }
    .role-icon { width:72px; height:72px; border-radius:20px; display:flex; align-items:center; justify-content:center; margin:0 auto 1.5rem; }
    .role-card h3 { font-size:1.3rem; font-weight:700; margin-bottom:0.5rem; }
    .role-card p { font-size:0.85rem; color:var(--text-sub); line-height:1.5; }
    .role-features { list-style:none; margin-top:1.5rem; text-align:left; padding:0; }
    .role-features li { padding:0.4rem 0; font-size:0.8rem; color:var(--text-sub); display:flex; align-items:center; gap:0.5rem; }
    .role-features li i { color:var(--success); width:16px; }
    @media (max-width:1024px) { .role-grid { grid-template-columns:1fr; } }
</style>
<div class="role-grid">
    <a href="{{ url('/demo/smart-school/guru') }}" class="role-card">
        <div class="role-icon" style="background:#4f46e515;color:#4f46e5;"><i data-lucide="graduation-cap" style="width:36px;height:36px;"></i></div>
        <h3>Masuk sebagai Guru</h3>
        <p>Kelola perangkat ajar, asesmen, jurnal harian, presensi, dan cetak rapor.</p>
        <ul class="role-features">
            <li><i data-lucide="check"></i> Library Modul Ajar</li>
            <li><i data-lucide="check"></i> Input Nilai & Narasi Otomatis</li>
            <li><i data-lucide="check"></i> Jurnal & Presensi Terpadu</li>
            <li><i data-lucide="check"></i> Smart Remedial</li>
            <li><i data-lucide="check"></i> Cetak Rapor Massal</li>
        </ul>
    </a>
    <a href="{{ url('/demo/smart-school/kepsek') }}" class="role-card">
        <div class="role-icon" style="background:#05966915;color:#059669;"><i data-lucide="briefcase" style="width:36px;height:36px;"></i></div>
        <h3>Masuk sebagai Kepala Sekolah</h3>
        <p>Pantau kepatuhan guru, analisis performa siswa, dan supervisi akademik real-time.</p>
        <ul class="role-features">
            <li><i data-lucide="check"></i> Dashboard Supervisi Real-time</li>
            <li><i data-lucide="check"></i> Smart Mapping & Analisis</li>
            <li><i data-lucide="check"></i> Supervisi Jurnal Guru</li>
            <li><i data-lucide="check"></i> Export Laporan Sekolah</li>
        </ul>
    </a>
    <a href="{{ url('/demo/smart-school/admin') }}" class="role-card">
        <div class="role-icon" style="background:#d9770615;color:#d97706;"><i data-lucide="shield" style="width:36px;height:36px;"></i></div>
        <h3>Masuk sebagai Admin</h3>
        <p>Atur pengguna, konfigurasi sistem, dan pantau aktivitas aplikasi.</p>
        <ul class="role-features">
            <li><i data-lucide="check"></i> Manajemen Pengguna</li>
            <li><i data-lucide="check"></i> Konfigurasi KKM</li>
            <li><i data-lucide="check"></i> Log Sistem</li>
        </ul>
    </a>
</div>
@endsection
