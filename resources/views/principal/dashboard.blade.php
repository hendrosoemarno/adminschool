@extends('layouts.app')

@section('title', 'Dashboard Kepala Sekolah')
@section('page_header', 'Dashboard Kepala Sekolah')
@section('page_subtitle', 'Selamat datang kembali, ' . session('moodle_user.fullname'))

@section('content')
<div class="modern-card" style="border-left: 4px solid var(--primary);">
    <h3 class="text-slate-800 font-bold mb-2">Informasi Sekolah</h3>
    <p class="text-slate-500">Anda sedang mengelola: <strong>{{ $school->school_name ?? 'Sekolah Tidak Terdeteksi' }}</strong></p>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-top: 2rem;">
    <div class="modern-card">
        <div class="text-xs font-bold text-slate-500 uppercase mb-4 text-center">Statistik Ringkas</div>
        <div style="text-align: center; padding: 2rem; opacity: 0.5;">
            <i data-lucide="bar-chart-3" style="width: 48px; height: 48px; margin-bottom: 1rem;"></i>
            <p>Data statistik sekolah akan muncul di sini.</p>
        </div>
    </div>
</div>
@endsection
