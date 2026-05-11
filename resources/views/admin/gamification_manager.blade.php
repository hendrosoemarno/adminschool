@extends('layouts.app')

@section('title', 'Gamification Manager - AI Learning')
@section('page_header', 'Manajemen Gamifikasi')
@section('page_subtitle', 'Konfigurasi pemicu lencana (badges) dan sistem pencapaian siswa.')

@section('content')
<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
    <!-- Badge Logic Config Card -->
    <div class="modern-card">
        <h3 class="text-slate-800 font-bold mb-6">Konfigurasi Pemicu Lencana (Badge Triggers)</h3>
        
        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
            <!-- Trigger Item 1 -->
            <div class="glass" style="padding: 1.5rem; border-radius: 24px; display: flex; gap: 1.5rem; align-items: center;">
                <div style="width: 60px; height: 60px; background: #fef3c7; border-radius: 18px; display: flex; align-items: center; justify-content: center; color: #b45309;">
                    <i data-lucide="zap" style="width: 28px;"></i>
                </div>
                <div style="flex: 1;">
                    <p class="font-bold text-slate-800">Lencana: Fast Learner</p>
                    <p class="text-xs text-slate-500 mb-3">Diberikan jika siswa mengerjakan kuis 2x lebih cepat dari rata-rata dengan skor > 80.</p>
                    <div style="display: flex; gap: 1rem; align-items: center;">
                        <input type="checkbox" checked style="width: 20px; height: 20px; accent-color: var(--primary);">
                        <span class="text-xs font-bold text-slate-500">Status: AKTIF</span>
                    </div>
                </div>
                <button class="btn-indigo" style="background: #f1f5f9; color: var(--text-title); box-shadow: none; font-size: 12px; padding: 8px 16px;">Edit Logika</button>
            </div>

            <!-- Trigger Item 2 -->
            <div class="glass" style="padding: 1.5rem; border-radius: 24px; display: flex; gap: 1.5rem; align-items: center;">
                <div style="width: 60px; height: 60px; background: #dcfce7; border-radius: 18px; display: flex; align-items: center; justify-content: center; color: #15803d;">
                    <i data-lucide="trending-up" style="width: 28px;"></i>
                </div>
                <div style="flex: 1;">
                    <p class="font-bold text-slate-800">Lencana: Growth King</p>
                    <p class="text-xs text-slate-500 mb-3">Diberikan jika terjadi kenaikan skor > 20% selama 3 kuis berturut-turut.</p>
                    <div style="display: flex; gap: 1rem; align-items: center;">
                        <input type="checkbox" checked style="width: 20px; height: 20px; accent-color: var(--primary);">
                        <span class="text-xs font-bold text-slate-500">Status: AKTIF</span>
                    </div>
                </div>
                <button class="btn-indigo" style="background: #f1f5f9; color: var(--text-title); box-shadow: none; font-size: 12px; padding: 8px 16px;">Edit Logika</button>
            </div>

            <!-- Trigger Item 3 -->
            <div class="glass" style="padding: 1.5rem; border-radius: 24px; display: flex; gap: 1.5rem; align-items: center; opacity: 0.6;">
                <div style="width: 60px; height: 60px; background: #e0e7ff; border-radius: 18px; display: flex; align-items: center; justify-content: center; color: #4338ca;">
                    <i data-lucide="shield-check" style="width: 28px;"></i>
                </div>
                <div style="flex: 1;">
                    <p class="font-bold text-slate-800">Lencana: Consistency Hero</p>
                    <p class="text-xs text-slate-500 mb-3">Diberikan jika siswa tidak pernah absen dalam 10 sesi ujian berturut-turut.</p>
                    <div style="display: flex; gap: 1rem; align-items: center;">
                        <input type="checkbox" style="width: 20px; height: 20px; accent-color: var(--primary);">
                        <span class="text-xs font-bold text-slate-500">Status: NON-AKTIF</span>
                    </div>
                </div>
                <button class="btn-indigo" style="background: #f1f5f9; color: var(--text-title); box-shadow: none; font-size: 12px; padding: 8px 16px;">Edit Logika</button>
            </div>
        </div>
    </div>

    <!-- Stats & Achievements Summary -->
    <div style="display: flex; flex-direction: column; gap: 2rem;">
        <div class="modern-card">
            <h3 class="text-slate-800 font-bold mb-4">Statistik Lencana</h3>
            <div style="display: flex; flex-direction: column; gap: 1rem;">
                <div class="flex justify-between items-center">
                    <span class="text-sm text-slate-500">Total Lencana Terbit</span>
                    <span class="font-bold">1,452</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-slate-500">Lencana Paling Populer</span>
                    <span class="badge-success">Fast Learner</span>
                </div>
            </div>
        </div>

        <div class="modern-card">
            <h3 class="text-slate-800 font-bold mb-4">Log Perolehan Terakhir</h3>
            <div style="display: flex; flex-direction: column; gap: 1rem;">
                <div style="display: flex; gap: 1rem; align-items: center;">
                    <div style="width: 32px; height: 32px; background: #f1f5f9; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 10px; font-weight: 800;">AP</div>
                    <div>
                        <p class="text-xs font-bold">Aditama Putra</p>
                        <p class="text-[10px] text-slate-500">Mendapat "Growth King" • 2m ago</p>
                    </div>
                </div>
                <div style="display: flex; gap: 1rem; align-items: center;">
                    <div style="width: 32px; height: 32px; background: #f1f5f9; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 10px; font-weight: 800;">BC</div>
                    <div>
                        <p class="text-xs font-bold">Bela Cantika</p>
                        <p class="text-[10px] text-slate-500">Mendapat "Fast Learner" • 1h ago</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
