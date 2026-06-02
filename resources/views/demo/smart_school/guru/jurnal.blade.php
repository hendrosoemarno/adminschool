@extends('layouts.smart_school')

@section('title', 'Jurnal Harian - Smart School')
@section('page_header', 'Jurnal Harian')
@section('page_subtitle', 'Catat aktivitas pembelajaran harian Anda.')
@section('breadcrumb', '<a href="/demo/smart-school/guru">Guru</a> / <a href="/demo/smart-school/guru/jurnal">Administrasi</a> / <span>Jurnal Harian</span>')

@section('styles')
<style>
    .form-grid { display:grid; grid-template-columns:1fr 1fr 1fr; gap:1rem; margin-bottom:1rem; }
    .form-group { margin-bottom:1rem; }
    .form-group label { display:block; font-size:0.75rem; font-weight:700; color:var(--text-sub); margin-bottom:0.35rem; }
    .form-group input, .form-group select { width:100%; padding:0.6rem 1rem; border:1px solid var(--border); border-radius:12px; font-size:0.85rem; background:var(--bg-card); color:var(--text-main); outline:none; }
    .form-group input:focus, .form-group select:focus { border-color:var(--primary); }
    .form-group textarea { width:100%; padding:0.6rem 1rem; border:1px solid var(--border); border-radius:12px; font-size:0.85rem; font-family:'Inter',sans-serif; background:var(--bg-card); color:var(--text-main); outline:none; resize:vertical; min-height:80px; }
    .form-group textarea:focus { border-color:var(--primary); }
    .filter-arsip { display:flex; gap:1rem; align-items:center; flex-wrap:wrap; margin-bottom:1rem; }
    .filter-arsip select, .filter-arsip input { padding:0.5rem 0.8rem; border:1px solid var(--border); border-radius:10px; font-size:0.8rem; background:var(--bg-card); color:var(--text-main); outline:none; }
</style>
@endsection

@section('content')
<div class="modern-card">
    <h4 style="font-size:1rem;font-weight:700;margin-bottom:1.25rem;"><i data-lucide="edit" style="width:18px;color:var(--primary);"></i> Form Jurnal Harian</h4>
    <div class="form-grid">
        <div class="form-group">
            <label>Tanggal</label>
            <input type="date" value="2026-05-27">
        </div>
        <div class="form-group">
            <label>Mata Pelajaran</label>
            <select>
                <option>Matematika Wajib</option>
                <option>Matematika Peminatan</option>
                <option>Fisika</option>
                <option>Kimia</option>
            </select>
        </div>
        <div class="form-group">
            <label>Kelas</label>
            <select>
                <option>XII IPA 1</option>
                <option>XII IPA 2</option>
                <option>XI IPA 1</option>
                <option>X IPA 1</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label>Materi yang Diajarkan</label>
        <textarea placeholder="Jelaskan materi yang diajarkan hari ini...">Barisan dan Deret Aritmetika: menentukan suku ke-n dan jumlah n suku pertama.</textarea>
    </div>
    <div class="form-group">
        <label>Kendala</label>
        <textarea placeholder="Kendala yang dihadapi selama pembelajaran...">Beberapa siswa masih kesulitan memahami konsep beda (selisih) pada barisan aritmetika.</textarea>
    </div>
    <div class="form-group">
        <label>Solusi</label>
        <textarea placeholder="Solusi yang dilakukan...">Memberikan contoh tambahan dan latihan soal bertahap. Rencana remedial untuk siswa yang nilainya di bawah KKM.</textarea>
    </div>
    <div style="display:flex;justify-content:flex-end;gap:0.75rem;">
        <button class="btn-outline-sm" onclick="alert('Demo: reset form jurnal');"><i data-lucide="rotate-ccw" style="width:16px;"></i> Reset</button>
        <button class="btn-indigo" onclick="alert('Demo: jurnal disimpan');"><i data-lucide="save" style="width:16px;"></i> Simpan Jurnal</button>
    </div>
</div>

<div class="modern-card" style="margin-top:1.25rem;">
    <h4 style="font-size:1rem;font-weight:700;margin-bottom:1rem;"><i data-lucide="archive" style="width:18px;color:var(--primary);"></i> Arsip Jurnal</h4>
    <div class="filter-arsip">
        <i data-lucide="filter" style="width:16px;color:var(--text-sub);"></i>
        <select>
            <option value="">Semua Kelas</option>
            <option>XII IPA 1</option>
            <option>XII IPA 2</option>
            <option>XI IPA 1</option>
        </select>
        <input type="date" value="">
        <button class="btn-outline-sm" onclick="alert('Demo: filter arsip');"><i data-lucide="search" style="width:14px;"></i> Filter</button>
    </div>
    <div class="table-wrapper">
        <table>
            <thead><tr><th>Tanggal</th><th>Mapel</th><th>Kelas</th><th>Materi</th><th>Aksi</th></tr></thead>
            <tbody>
                <tr><td>27 Mei 2026</td><td>Matematika Wajib</td><td>XII IPA 1</td><td>Barisan dan Deret Aritmetika</td><td><button class="btn-outline-sm" style="padding:0.3rem 0.7rem;font-size:0.7rem;" onclick="alert('Demo: lihat detail jurnal');"><i data-lucide="eye" style="width:14px;"></i> Detail</button></td></tr>
                <tr><td>26 Mei 2026</td><td>Matematika Wajib</td><td>XII IPA 2</td><td>Barisan dan Deret Geometri</td><td><button class="btn-outline-sm" style="padding:0.3rem 0.7rem;font-size:0.7rem;" onclick="alert('Demo: lihat detail jurnal');"><i data-lucide="eye" style="width:14px;"></i> Detail</button></td></tr>
                <tr><td>23 Mei 2026</td><td>Matematika Peminatan</td><td>XI IPA 1</td><td>Trigonometri Lanjutan</td><td><button class="btn-outline-sm" style="padding:0.3rem 0.7rem;font-size:0.7rem;" onclick="alert('Demo: lihat detail jurnal');"><i data-lucide="eye" style="width:14px;"></i> Detail</button></td></tr>
                <tr><td>22 Mei 2026</td><td>Matematika Wajib</td><td>X IPA 1</td><td>Vektor dan Operasinya</td><td><button class="btn-outline-sm" style="padding:0.3rem 0.7rem;font-size:0.7rem;" onclick="alert('Demo: lihat detail jurnal');"><i data-lucide="eye" style="width:14px;"></i> Detail</button></td></tr>
                <tr><td>21 Mei 2026</td><td>Matematika Peminatan</td><td>XII IPA 1</td><td>Limit Fungsi Trigonometri</td><td><button class="btn-outline-sm" style="padding:0.3rem 0.7rem;font-size:0.7rem;" onclick="alert('Demo: lihat detail jurnal');"><i data-lucide="eye" style="width:14px;"></i> Detail</button></td></tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
