@extends('layouts.app')

@section('title', 'Admin Dashboard - AI Learning')
@section('page_header', 'Orchestrator Kuis')
@section('page_subtitle', 'Kelola alokasi kuis dan urutan pemetaan kompetensi.')

@section('content')
<div class="stat-group">
    <div class="modern-card" onclick="window.location='/admin/active-quizzes'" style="cursor: pointer; border-left: 4px solid var(--primary);">
        <div class="text-xs font-bold text-slate-500 uppercase mb-1">Total Kuis Aktif</div>
        <div class="text-3xl font-bold text-slate-800">24</div>
        <p class="text-xs text-emerald-600 mt-2 font-bold">+12% dari bulan lalu</p>
    </div>
    <div class="modern-card" onclick="window.location='/admin/registered-students'" style="cursor: pointer; border-left: 4px solid var(--primary);">
        <div class="text-xs font-bold text-slate-500 uppercase mb-1">Siswa Terdaftar</div>
        <div class="text-3xl font-bold text-slate-800">1,284</div>
        <p class="text-xs text-slate-500 mt-2">Tersebar di 12 Sekolah</p>
    </div>
    <div class="modern-card" onclick="window.location='/admin/competency-mapping'" style="cursor: pointer; border-left: 4px solid var(--primary);">
        <div class="text-xs font-bold text-slate-500 uppercase mb-1">Mapping Kompetensi</div>
        <div class="text-3xl font-bold text-slate-800">85%</div>
        <div class="progress-container mt-3">
            <div class="progress-fill" style="width: 85%;"></div>
        </div>
    </div>
</div>

<div class="modern-card" style="margin-bottom: 2rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <div>
            <h3 class="text-slate-800 font-bold">Daftar Kuis Moodle</h3>
            <p class="text-sm text-slate-500">Gunakan fitur drag-and-drop untuk mengatur urutan kuis.</p>
        </div>
        <button class="btn-indigo">
            <i data-lucide="plus" style="width: 18px;"></i> Alokasi Kuis Baru
        </button>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Urutan</th>
                    <th>Nama Kuis (Moodle)</th>
                    <th>Sekolah / Tingkat</th>
                    <th>Threshold</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="font-bold">#1</td>
                    <td>
                        <div class="font-bold text-slate-800">FIS-MC-01-Mekanika Dasar</div>
                        <span class="text-xs text-slate-400">ID: 452</span>
                    </td>
                    <td>SMA Negeri 1 Jakarta / XI</td>
                    <td>80%</td>
                    <td><span class="badge-success" style="padding: 4px 12px; border-radius: 12px; font-size: 10px; font-weight: 800; background: #dcfce7; color: #15803d;">AKTIF</span></td>
                    <td>
                        <button style="border: none; background: none; color: var(--text-body); cursor: pointer;"><i data-lucide="more-vertical" style="width: 18px;"></i></button>
                    </td>
                </tr>
                <tr>
                    <td class="font-bold">#2</td>
                    <td>
                        <div class="font-bold text-slate-800">MAT-MC-05-Logaritma Lanjut</div>
                        <span class="text-xs text-slate-400">ID: 458</span>
                    </td>
                    <td>SMA Kristen 1 / XII</td>
                    <td>75%</td>
                    <td><span class="badge-success" style="padding: 4px 12px; border-radius: 12px; font-size: 10px; font-weight: 800; background: #dcfce7; color: #15803d;">AKTIF</span></td>
                    <td>
                        <button style="border: none; background: none; color: var(--text-body); cursor: pointer;"><i data-lucide="more-vertical" style="width: 18px;"></i></button>
                    </td>
                </tr>
                <tr>
                    <td class="font-bold">#3</td>
                    <td>
                        <div class="font-bold text-slate-800">BIO-MC-02-Sel & Jaringan</div>
                        <span class="text-xs text-slate-400">ID: 460</span>
                    </td>
                    <td>SMAS Al-Azhar / X</td>
                    <td>85%</td>
                    <td><span class="badge-warning" style="padding: 4px 12px; border-radius: 12px; font-size: 10px; font-weight: 800; background: #fef3c7; color: #b45309;">PENDING</span></td>
                    <td>
                        <button style="border: none; background: none; color: var(--text-body); cursor: pointer;"><i data-lucide="more-vertical" style="width: 18px;"></i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
