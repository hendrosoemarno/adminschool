@extends('layouts.smart_school')

@section('title', 'Smart Remedial - Smart School')
@section('page_header', 'Smart Remedial')
@section('page_subtitle', 'Siswa dengan nilai di bawah KKM (70) otomatis terfilter untuk tindak lanjut.')
@section('breadcrumb', '<a href="/demo/smart-school/guru">Guru</a> / <a href="/demo/smart-school/guru/remedial">Administrasi</a> / <span>Smart Remedial</span>')

@section('styles')
<style>
    .info-banner { display:flex; align-items:center; gap:0.75rem; padding:1rem 1.25rem; background:#dc262615; border:1px solid #fecaca; border-radius:16px; margin-bottom:1.5rem; font-size:0.85rem; font-weight:600; color:var(--danger); }
    .filter-bar { display:flex; gap:1rem; align-items:center; flex-wrap:wrap; margin-bottom:1.5rem; }
    .filter-bar select { padding:0.6rem 1rem; border:1px solid var(--border); border-radius:12px; font-size:0.85rem; background:var(--bg-card); color:var(--text-main); outline:none; }
    .remedial-grid { display:grid; grid-template-columns:1fr 1fr 1fr; gap:1rem; margin-top:1.25rem; }
    .remedial-card { background:var(--bg-card); border:1px solid var(--border); border-radius:18px; padding:1.25rem; transition:all 0.2s; }
    .remedial-card:hover { border-color:var(--primary); }
    .remedial-card h5 { font-size:0.9rem; font-weight:700; margin-bottom:0.4rem; }
    .remedial-card .meta { font-size:0.75rem; color:var(--text-sub); }
    .remedial-card .students { margin-top:0.75rem; display:flex; flex-wrap:wrap; gap:0.3rem; }
    .remedial-card .students span { background:var(--border); padding:0.15rem 0.5rem; border-radius:6px; font-size:0.7rem; font-weight:600; }
</style>
@endsection

@section('content')
<div class="info-banner">
    <i data-lucide="alert-triangle" style="width:20px;flex-shrink:0;"></i>
    <span>Siswa dengan nilai di bawah KKM (70) otomatis terfilter untuk program remedial.</span>
</div>

<div class="modern-card">
    <div class="filter-bar">
        <i data-lucide="filter" style="width:18px;color:var(--text-sub);"></i>
        <select>
            <option value="">Semua Mapel</option>
            <option>Matematika Wajib</option>
            <option>Matematika Peminatan</option>
            <option>Fisika</option>
            <option>Kimia</option>
        </select>
        <select>
            <option value="">Semua Kelas</option>
            <option>XII IPA 1</option>
            <option>XII IPA 2</option>
            <option>XI IPA 1</option>
        </select>
        <button class="btn-indigo" onclick="alert('Demo: filter remedial');"><i data-lucide="search" style="width:16px;"></i> Filter</button>
    </div>
</div>

<div class="modern-card" style="margin-top:1.25rem;">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1rem;">
        <h4 style="font-size:1rem;font-weight:700;"><i data-lucide="alert-triangle" style="width:18px;color:var(--danger);"></i> Siswa di Bawah KKM</h4>
        <span style="font-size:0.75rem;color:var(--text-sub);">Ditemukan 4 siswa</span>
    </div>
    <div class="table-wrapper">
        <table>
            <thead><tr><th>No</th><th>Nama</th><th>Kelas</th><th>Nilai</th><th>Topik Remedial</th><th>Status</th></tr></thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td><strong>Dian Permata</strong></td>
                    <td>XII IPA 1</td>
                    <td><span class="badge-red">55</span></td>
                    <td><span style="font-size:0.8rem;">Trigonometri, Limit Fungsi</span></td>
                    <td><span class="badge-yellow">Menunggu</span></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td><strong>Gilang Ramadhan</strong></td>
                    <td>XII IPA 1</td>
                    <td><span class="badge-red">60</span></td>
                    <td><span style="font-size:0.8rem;">Barisan dan Deret Geometri</span></td>
                    <td><span class="badge-yellow">Menunggu</span></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td><strong>Joko Susilo</strong></td>
                    <td>XII IPA 1</td>
                    <td><span class="badge-red">62</span></td>
                    <td><span style="font-size:0.8rem;">Peluang, Matriks</span></td>
                    <td><span class="badge-green">Terjadwal</span></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td><strong>Ahmad Fauzi</strong></td>
                    <td>XII IPA 1</td>
                    <td><span class="badge-red">68</span></td>
                    <td><span style="font-size:0.8rem;">Limit Fungsi</span></td>
                    <td><span class="badge-green">Terjadwal</span></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div style="margin-top:1.25rem; display:flex; justify-content:flex-end;">
        <button class="btn-indigo" onclick="alert('Demo: generate rencana tindak lanjut');"><i data-lucide="sparkles" style="width:16px;"></i> Generate Rencana Tindak Lanjut</button>
    </div>
</div>

<div style="margin-top:1.25rem;">
    <h4 style="font-size:1rem;font-weight:700;margin-bottom:1rem;display:flex;align-items:center;gap:0.5rem;"><i data-lucide="calendar-check" style="width:18px;color:var(--primary);"></i> Rencana Remedial</h4>
    <div class="remedial-grid">
        <div class="remedial-card">
            <h5>Trigonometri & Limit</h5>
            <div class="meta"><i data-lucide="calendar" style="width:12px;"></i> 3 Juni 2026</div>
            <div class="students">
                <span>Dian Permata</span>
                <span>Gilang Ramadhan</span>
            </div>
        </div>
        <div class="remedial-card">
            <h5>Barisan Geometri</h5>
            <div class="meta"><i data-lucide="calendar" style="width:12px;"></i> 5 Juni 2026</div>
            <div class="students">
                <span>Gilang Ramadhan</span>
                <span>Joko Susilo</span>
            </div>
        </div>
        <div class="remedial-card">
            <h5>Peluang & Matriks</h5>
            <div class="meta"><i data-lucide="calendar" style="width:12px;"></i> 7 Juni 2026</div>
            <div class="students">
                <span>Joko Susilo</span>
                <span>Ahmad Fauzi</span>
            </div>
        </div>
    </div>
</div>
@endsection
