@extends('layouts.app')

@section('title', 'Dashboard Guru Mapel')
@section('page_header', 'Dashboard Guru Mata Pelajaran')
@section('page_subtitle', 'Selamat datang kembali, ' . session('moodle_user.fullname'))

@section('content')
<div class="modern-card" style="border-left: 4px solid #f59e0b;">
    <h3 class="text-slate-800 font-bold mb-4">Penugasan Mata Pelajaran</h3>
    @if($assignments->count() > 0)
        <div style="display: flex; flex-direction: column; gap: 1rem;">
            @foreach($assignments as $assign)
                <div class="glass" style="padding: 1rem; border-radius: 12px; display: flex; justify-content: space-between; align-items: center;">
                    <span class="font-bold text-slate-700">Mata Pelajaran ID: {{ $assign->competency_id }}</span>
                    <span class="badge-primary">Pengajar Aktif</span>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-slate-500 italic">Belum ada penugasan mata pelajaran terdeteksi.</p>
    @endif
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-top: 2rem;">
    <div class="modern-card">
        <div class="text-xs font-bold text-slate-500 uppercase mb-4 text-center">Analisis Capaian</div>
        <div style="text-align: center; padding: 2rem; opacity: 0.5;">
            <i data-lucide="book-open" style="width: 48px; height: 48px; margin-bottom: 1rem;"></i>
            <p>Data progres siswa per mapel akan muncul di sini.</p>
        </div>
    </div>
</div>
@endsection
