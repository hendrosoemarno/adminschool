@extends('layouts.app')

@section('title', 'Dashboard Wali Kelas')
@section('page_header', 'Dashboard Wali Kelas')
@section('page_subtitle', 'Selamat datang kembali, ' . session('moodle_user.fullname'))

@section('content')
<div class="modern-card" style="border-left: 4px solid var(--success);">
    <h3 class="text-slate-800 font-bold mb-2">Informasi Rombongan Belajar</h3>
    <p class="text-slate-500">Anda adalah Wali Kelas dari: <strong>{{ $class->class_name ?? 'Kelas Tidak Terdeteksi' }}</strong></p>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-top: 2rem;">
    <div class="modern-card">
        <div class="text-xs font-bold text-slate-500 uppercase mb-4 text-center">Data Siswa Kelas</div>
        <div style="text-align: center; padding: 2rem; opacity: 0.5;">
            <i data-lucide="users" style="width: 48px; height: 48px; margin-bottom: 1rem;"></i>
            <p>Daftar siswa di kelas Anda akan muncul di sini.</p>
        </div>
    </div>
</div>
@endsection
