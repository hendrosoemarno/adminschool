@extends('layouts.app')

@section('title', 'Verifikasi Identitas - AI Learning')
@section('page_header', 'Konfirmasi Data Ujian')
@section('page_subtitle', 'Harap periksa kembali data diri Anda sebelum memulai sesi kuis.')

@section('content')
<div style="max-width: 900px; margin: 0 auto;">
    <div style="display: grid; grid-template-columns: 1fr 1.5fr; gap: 2.5rem;">
        <!-- Student Identity Card -->
        <div class="modern-card" style="text-align: center; padding: 3rem 2rem;">
            <div style="width: 120px; height: 120px; background: #e0e7ff; border-radius: 50%; margin: 0 auto 2rem; display: flex; align-items: center; justify-content: center; color: var(--primary); border: 4px solid white; box-shadow: var(--shadow-md);">
                <i data-lucide="user" style="width: 64px; height: 64px;"></i>
            </div>
            <h2 class="text-slate-800 font-bold" style="font-size: 1.5rem;">Aditama Putra</h2>
            <p class="text-sm text-slate-500 mb-6">NISN: 20210001</p>
            
            <div style="text-align: left; background: #f8fafc; padding: 1.5rem; border-radius: 20px; border: 1px solid var(--border);">
                <div style="margin-bottom: 1rem;">
                    <p class="text-[10px] font-bold text-slate-400 uppercase">Sekolah</p>
                    <p class="text-sm font-bold text-slate-700">SMA Negeri 1 Jakarta</p>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase">Tingkat / Kelas</p>
                    <p class="text-sm font-bold text-slate-700">Kelas XII / IPA 1</p>
                </div>
            </div>
        </div>

        <!-- Exam Details Card -->
        <div style="display: flex; flex-direction: column; gap: 2rem;">
            <div class="modern-card">
                <h3 class="text-slate-800 font-bold mb-6">Informasi Ujian</h3>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div class="glass" style="padding: 1.25rem; border-radius: 20px;">
                        <p class="text-xs text-slate-500 mb-1">Mata Pelajaran</p>
                        <p class="font-bold text-indigo-600">FISIKA TKA</p>
                    </div>
                    <div class="glass" style="padding: 1.25rem; border-radius: 20px;">
                        <p class="text-xs text-slate-500 mb-1">ID Sesi</p>
                        <p class="font-bold text-slate-800">#452-MC-01</p>
                    </div>
                    <div class="glass" style="padding: 1.25rem; border-radius: 20px;">
                        <p class="text-xs text-slate-500 mb-1">Durasi</p>
                        <p class="font-bold text-slate-800">90 Menit</p>
                    </div>
                    <div class="glass" style="padding: 1.25rem; border-radius: 20px;">
                        <p class="text-xs text-slate-500 mb-1">Jumlah Soal</p>
                        <p class="font-bold text-slate-800">40 Butir</p>
                    </div>
                </div>
            </div>

            <!-- Rules & Integrity -->
            <div class="modern-card" style="border-left: 6px solid var(--warning);">
                <h3 class="text-slate-800 font-bold mb-4">Instruksi & Pakta Integritas</h3>
                <ul style="padding-left: 1.5rem; display: flex; flex-direction: column; gap: 0.5rem;" class="text-sm text-slate-600">
                    <li>Dilarang berpindah tab browser selama ujian berlangsung.</li>
                    <li>Sistem akan mencatat setiap aktivitas mencurigakan.</li>
                    <li>Jawaban tersimpan otomatis setiap menit (Auto-Save).</li>
                </ul>
                
                <div style="margin-top: 2rem; display: flex; align-items: center; gap: 1rem; padding: 1rem; background: #fffbeb; border-radius: 16px;">
                    <input type="checkbox" id="agree" style="width: 24px; height: 24px; accent-color: var(--primary); cursor: pointer;">
                    <label for="agree" class="text-xs font-bold text-amber-700" style="cursor: pointer;">
                        Saya menyatakan data di atas benar dan siap mengerjakan ujian dengan jujur.
                    </label>
                </div>

                <button class="btn-indigo" style="width: 100%; justify-content: center; margin-top: 2rem; padding: 1.25rem; font-size: 1.125rem;">
                    Mulai Kerjakan Ujian Sekarang
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
