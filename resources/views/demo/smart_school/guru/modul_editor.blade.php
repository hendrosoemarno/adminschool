@extends('layouts.smart_school')

@section('title', 'Editor Modul - Smart School')
@section('page_header', 'Editor Modul')
@section('page_subtitle', 'Buat dan edit modul ajar dengan mudah.')
@section('breadcrumb', '<a href="/demo/smart-school/guru">Guru</a> / <a href="/demo/smart-school/guru/modul">Perangkat Ajar</a> / <span>Editor Modul</span>')

@section('styles')
<style>
    .form-group { margin-bottom:1.25rem; }
    .form-group label { display:block; font-size:0.8rem; font-weight:700; color:var(--text-sub); margin-bottom:0.4rem; }
    .form-group input, .form-group select { width:100%; padding:0.7rem 1rem; border:1px solid var(--border); border-radius:12px; font-size:0.85rem; background:var(--bg-card); color:var(--text-main); outline:none; transition:border-color 0.2s; }
    .form-group input:focus, .form-group select:focus { border-color:var(--primary); }
    .editor-area { width:100%; min-height:400px; padding:1rem; border:1px solid var(--border); border-radius:16px; font-size:0.9rem; font-family:'Inter',sans-serif; background:var(--bg-card); color:var(--text-main); outline:none; resize:vertical; transition:border-color 0.2s; line-height:1.7; }
    .editor-area:focus { border-color:var(--primary); }
    .editor-toolbar { display:flex; gap:0.4rem; padding:0.5rem 0.75rem; border:1px solid var(--border); border-bottom:none; border-radius:16px 16px 0 0; background:var(--bg-card); flex-wrap:wrap; }
    .editor-toolbar button { width:34px; height:34px; border-radius:8px; border:none; background:transparent; color:var(--text-sub); cursor:pointer; display:flex; align-items:center; justify-content:center; transition:all 0.2s; font-size:0.9rem; }
    .editor-toolbar button:hover { background:var(--border); }
    .editor-wrap { margin-bottom:1.5rem; }
    .preview-toggle { display:flex; gap:0.5rem; margin-bottom:1rem; }
    .preview-toggle button { padding:0.5rem 1.25rem; border-radius:10px; border:1px solid var(--border); background:var(--bg-card); color:var(--text-sub); font-weight:600; font-size:0.8rem; cursor:pointer; transition:all 0.2s; }
    .preview-toggle button.active { background:var(--primary); color:#fff; border-color:var(--primary); }
</style>
@endsection

@section('content')
<div style="display:grid; grid-template-columns:1fr 1fr; gap:1.5rem;">
    <div class="modern-card">
        <h4 style="font-size:1rem;font-weight:700;margin-bottom:1.25rem;"><i data-lucide="settings" style="width:18px;color:var(--primary);"></i> Info Modul</h4>
        <div class="form-group">
            <label>Judul Modul</label>
            <input type="text" value="Barisan dan Deret" placeholder="Masukkan judul modul">
        </div>
        <div class="form-group">
            <label>Mata Pelajaran</label>
            <select>
                <option>Matematika Wajib</option>
                <option>Matematika Peminatan</option>
                <option>Fisika</option>
                <option>Kimia</option>
                <option>Biologi</option>
            </select>
        </div>
        <div class="form-group">
            <label>Kelas</label>
            <select>
                <option>XII IPA 1</option>
                <option>XII IPA 2</option>
                <option>XI IPA 1</option>
                <option>XI IPA 2</option>
                <option>X IPA 1</option>
                <option>X IPA 2</option>
            </select>
        </div>
        <div class="form-group">
            <label>Status</label>
            <select>
                <option>Draft</option>
                <option>Published</option>
            </select>
        </div>
    </div>

    <div class="modern-card">
        <h4 style="font-size:1rem;font-weight:700;margin-bottom:1.25rem;"><i data-lucide="info" style="width:18px;color:var(--primary);"></i> Petunjuk Cepat</h4>
        <ul style="font-size:0.85rem;color:var(--text-sub);line-height:2;list-style:none;padding:0;">
            <li><i data-lucide="check" style="width:14px;color:var(--success);"></i> Gunakan toolbar untuk format teks</li>
            <li><i data-lucide="check" style="width:14px;color:var(--success);"></i> Simpan draft untuk melanjutkan nanti</li>
            <li><i data-lucide="check" style="width:14px;color:var(--success);"></i> Preview untuk melihat hasil akhir</li>
            <li><i data-lucide="check" style="width:14px;color:var(--success);"></i> Publikasikan jika modul sudah siap</li>
        </ul>
        <div style="margin-top:1rem;padding:1rem;background:#f5f3ff;border-radius:16px;border:1px solid #ede9fe;">
            <p style="font-size:0.8rem;color:var(--primary);font-weight:600;"><i data-lucide="lightbulb" style="width:16px;"></i> Tips: Tulis tujuan pembelajaran di awal modul!</p>
        </div>
    </div>
</div>

<div class="modern-card" style="margin-top:1.25rem;">
    <div class="preview-toggle">
        <button class="active" onclick="alert('Demo: beralih ke mode edit');">Edit</button>
        <button onclick="alert('Demo: beralih ke mode preview');">Preview</button>
    </div>
    <div class="editor-toolbar">
        <button onclick="alert('Demo: bold');" title="Bold"><strong>B</strong></button>
        <button onclick="alert('Demo: italic');" title="Italic"><em>I</em></button>
        <button onclick="alert('Demo: underline');" title="Underline"><u>U</u></button>
        <button onclick="alert('Demo: heading');" title="Heading">H</button>
        <button onclick="alert('Demo: list');" title="List"><i data-lucide="list" style="width:16px;"></i></button>
        <button onclick="alert('Demo: numbered list');" title="Numbered List"><i data-lucide="list-ordered" style="width:16px;"></i></button>
        <button onclick="alert('Demo: link');" title="Link"><i data-lucide="link" style="width:16px;"></i></button>
        <button onclick="alert('Demo: image');" title="Image"><i data-lucide="image" style="width:16px;"></i></button>
        <button onclick="alert('Demo: table');" title="Table"><i data-lucide="table" style="width:16px;"></i></button>
    </div>
    <textarea class="editor-area" placeholder="Tulis konten modul ajar di sini..."># Barisan dan Deret

## Kompetensi Dasar
3.6 Mengidentifikasi pola barisan dan deret aritmetika serta geometri.

## Tujuan Pembelajaran
- Siswa mampu menentukan suku ke-n suatu barisan aritmetika
- Siswa mampu menghitung jumlah n suku pertama deret aritmetika

## Materi
Barisan aritmetika adalah barisan yang memiliki selisih tetap antara dua suku berurutan.</textarea>
</div>

<div style="margin-top:1.25rem; display:flex; gap:1rem; justify-content:flex-end;">
    <button class="btn-outline-sm" onclick="alert('Demo: simpan sebagai draft');"><i data-lucide="save" style="width:16px;"></i> Simpan Draft</button>
    <button class="btn-success" onclick="alert('Demo: publikasikan modul');"><i data-lucide="check-circle" style="width:16px;"></i> Publikasikan</button>
</div>
@endsection
