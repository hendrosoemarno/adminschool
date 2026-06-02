@extends('layouts.smart_school')

@section('title', 'Daftar Modul Ajar - Smart School')
@section('page_header', 'Daftar Modul Ajar')
@section('page_subtitle', 'Kelola dan akses seluruh modul ajar yang telah dibuat.')
@section('breadcrumb', '<a href="/demo/smart-school/guru">Guru</a> / <a href="/demo/smart-school/guru/modul">Perangkat Ajar</a> / <span>Daftar Modul</span>')

@section('styles')
<style>
    .filter-bar { display:flex; gap:1rem; align-items:center; flex-wrap:wrap; margin-bottom:1.5rem; }
    .filter-bar input, .filter-bar select { padding:0.6rem 1rem; border:1px solid var(--border); border-radius:12px; font-size:0.85rem; background:var(--bg-card); color:var(--text-main); outline:none; transition:border-color 0.2s; }
    .filter-bar input:focus, .filter-bar select:focus { border-color:var(--primary); }
    .filter-bar input { flex:1; min-width:200px; }
    .status-draft { background:#d9770615; color:var(--warning); padding:0.2rem 0.6rem; border-radius:9999px; font-size:0.7rem; font-weight:700; }
    .status-published { background:#05966915; color:var(--success); padding:0.2rem 0.6rem; border-radius:9999px; font-size:0.7rem; font-weight:700; }
    .aksi-btn { display:inline-flex; align-items:center; gap:0.3rem; padding:0.3rem 0.7rem; border-radius:8px; font-size:0.75rem; font-weight:600; cursor:pointer; border:none; transition:all 0.2s; text-decoration:none; }
    .aksi-btn.preview { background:#4f46e515; color:var(--primary); }
    .aksi-btn.preview:hover { background:var(--primary); color:#fff; }
    .aksi-btn.edit { background:#05966915; color:var(--success); }
    .aksi-btn.edit:hover { background:var(--success); color:#fff; }
</style>
@endsection

@section('content')
<div class="modern-card">
    <div class="filter-bar">
        <input type="text" placeholder="Cari modul ajar..." value="">
        <select>
            <option value="">Semua Kelas</option>
            <option>X IPA 1</option>
            <option>X IPA 2</option>
            <option>XI IPA 1</option>
            <option>XI IPA 2</option>
            <option>XII IPA 1</option>
            <option>XII IPA 2</option>
        </select>
        <select>
            <option value="">Semua Status</option>
            <option>Draft</option>
            <option>Published</option>
        </select>
        <button class="btn-indigo" onclick="alert('Demo: filter diterapkan');"><i data-lucide="search" style="width:16px;"></i> Cari</button>
    </div>
</div>

<div class="modern-card" style="margin-top:1.25rem;">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr><th>No</th><th>Nama Modul</th><th>Mapel</th><th>Kelas</th><th>Status</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td><strong>Barisan dan Deret</strong></td>
                    <td>Matematika Wajib</td>
                    <td>XII IPA 1</td>
                    <td><span class="status-published">Published</span></td>
                    <td>
                        <a href="#" class="aksi-btn preview" onclick="alert('Demo: preview modul');return false;"><i data-lucide="eye" style="width:14px;"></i> Preview</a>
                        <a href="#" class="aksi-btn edit" onclick="alert('Demo: edit modul');return false;"><i data-lucide="edit" style="width:14px;"></i> Edit</a>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td><strong>Trigonometri Lanjutan</strong></td>
                    <td>Matematika Peminatan</td>
                    <td>XI IPA 1</td>
                    <td><span class="status-published">Published</span></td>
                    <td>
                        <a href="#" class="aksi-btn preview" onclick="alert('Demo: preview modul');return false;"><i data-lucide="eye" style="width:14px;"></i> Preview</a>
                        <a href="#" class="aksi-btn edit" onclick="alert('Demo: edit modul');return false;"><i data-lucide="edit" style="width:14px;"></i> Edit</a>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td><strong>Vektor dan Operasinya</strong></td>
                    <td>Matematika Wajib</td>
                    <td>X IPA 1</td>
                    <td><span class="status-draft">Draft</span></td>
                    <td>
                        <a href="#" class="aksi-btn preview" onclick="alert('Demo: preview modul');return false;"><i data-lucide="eye" style="width:14px;"></i> Preview</a>
                        <a href="#" class="aksi-btn edit" onclick="alert('Demo: edit modul');return false;"><i data-lucide="edit" style="width:14px;"></i> Edit</a>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td><strong>Limit Fungsi</strong></td>
                    <td>Matematika Peminatan</td>
                    <td>XII IPA 2</td>
                    <td><span class="status-published">Published</span></td>
                    <td>
                        <a href="#" class="aksi-btn preview" onclick="alert('Demo: preview modul');return false;"><i data-lucide="eye" style="width:14px;"></i> Preview</a>
                        <a href="#" class="aksi-btn edit" onclick="alert('Demo: edit modul');return false;"><i data-lucide="edit" style="width:14px;"></i> Edit</a>
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td><strong>Matriks dan Transformasi</strong></td>
                    <td>Matematika Wajib</td>
                    <td>XI IPA 2</td>
                    <td><span class="status-draft">Draft</span></td>
                    <td>
                        <a href="#" class="aksi-btn preview" onclick="alert('Demo: preview modul');return false;"><i data-lucide="eye" style="width:14px;"></i> Preview</a>
                        <a href="#" class="aksi-btn edit" onclick="alert('Demo: edit modul');return false;"><i data-lucide="edit" style="width:14px;"></i> Edit</a>
                    </td>
                </tr>
                <tr>
                    <td>6</td>
                    <td><strong>Peluang dan Statistik</strong></td>
                    <td>Matematika Wajib</td>
                    <td>X IPA 2</td>
                    <td><span class="status-published">Published</span></td>
                    <td>
                        <a href="#" class="aksi-btn preview" onclick="alert('Demo: preview modul');return false;"><i data-lucide="eye" style="width:14px;"></i> Preview</a>
                        <a href="#" class="aksi-btn edit" onclick="alert('Demo: edit modul');return false;"><i data-lucide="edit" style="width:14px;"></i> Edit</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div style="margin-top:1.25rem; display:flex; justify-content:flex-end;">
    <button class="btn-indigo" onclick="alert('Demo: buat modul baru');"><i data-lucide="plus" style="width:16px;"></i> Buat Modul Baru</button>
</div>
@endsection
