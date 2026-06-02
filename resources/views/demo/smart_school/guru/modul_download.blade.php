@extends('layouts.smart_school')

@section('title', 'Download Center - Smart School')
@section('page_header', 'Download Center')
@section('page_subtitle', 'Unduh template perangkat ajar siap pakai.')
@section('breadcrumb')
<a href="{{ url('/demo/smart-school/guru') }}">Guru</a> / <a href="{{ url('/demo/smart-school/guru/modul') }}">Perangkat Ajar</a> / <span>Download Center</span>
@endsection

@section('styles')
<style>
    .download-grid { display:grid; gap:1rem; }
    .download-item { display:flex; align-items:center; justify-content:space-between; padding:1rem 1.25rem; background:var(--bg-card); border:1px solid var(--border); border-radius:16px; transition:all 0.2s; }
    .download-item:hover { border-color:var(--primary); }
    .download-info { display:flex; align-items:center; gap:1rem; }
    .download-info .icon-box { width:44px; height:44px; border-radius:12px; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
    .download-info h4 { font-size:0.9rem; font-weight:700; margin-bottom:0.15rem; }
    .download-info .meta { font-size:0.75rem; color:var(--text-sub); display:flex; gap:1rem; }
    .download-btn { display:inline-flex; align-items:center; gap:0.5rem; padding:0.5rem 1.25rem; border-radius:10px; background:var(--primary); color:#fff; border:none; font-weight:600; font-size:0.8rem; cursor:pointer; transition:all 0.2s; text-decoration:none; }
    .download-btn:hover { transform:translateY(-2px); filter:brightness(1.1); }
</style>
@endsection

@section('content')
<div class="modern-card">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem;">
        <h4 style="font-size:1rem;font-weight:700;"><i data-lucide="download" style="width:18px;color:var(--primary);"></i> Template Perangkat Ajar</h4>
        <span style="font-size:0.75rem;color:var(--text-sub);">Tersedia 5 template</span>
    </div>
    <div class="download-grid">
        <div class="download-item">
            <div class="download-info">
                <div class="icon-box" style="background:#4f46e515;color:var(--primary);"><i data-lucide="file-text" style="width:20px;"></i></div>
                <div>
                    <h4>Template RPP Merdeka</h4>
                    <div class="meta"><span><i data-lucide="book" style="width:12px;"></i> Semua Mapel</span><span><i data-lucide="file" style="width:12px;"></i> DOCX</span><span><i data-lucide="hard-drive" style="width:12px;"></i> 245 KB</span></div>
                </div>
            </div>
            <a href="#" class="download-btn" onclick="alert('Demo: mengunduh template');return false;"><i data-lucide="download" style="width:16px;"></i> Download</a>
        </div>
        <div class="download-item">
            <div class="download-info">
                <div class="icon-box" style="background:#05966915;color:var(--success);"><i data-lucide="file-text" style="width:20px;"></i></div>
                <div>
                    <h4>Template Modul Ajar</h4>
                    <div class="meta"><span><i data-lucide="book" style="width:12px;"></i> Semua Mapel</span><span><i data-lucide="file" style="width:12px;"></i> DOCX</span><span><i data-lucide="hard-drive" style="width:12px;"></i> 312 KB</span></div>
                </div>
            </div>
            <a href="#" class="download-btn" onclick="alert('Demo: mengunduh template');return false;"><i data-lucide="download" style="width:16px;"></i> Download</a>
        </div>
        <div class="download-item">
            <div class="download-info">
                <div class="icon-box" style="background:#d9770615;color:var(--warning);"><i data-lucide="file-text" style="width:20px;"></i></div>
                <div>
                    <h4>Panduan Penyusunan ATP</h4>
                    <div class="meta"><span><i data-lucide="book" style="width:12px;"></i> Semua Mapel</span><span><i data-lucide="file" style="width:12px;"></i> PDF</span><span><i data-lucide="hard-drive" style="width:12px;"></i> 1.2 MB</span></div>
                </div>
            </div>
            <a href="#" class="download-btn" onclick="alert('Demo: mengunduh template');return false;"><i data-lucide="download" style="width:16px;"></i> Download</a>
        </div>
        <div class="download-item">
            <div class="download-info">
                <div class="icon-box" style="background:#dc262615;color:var(--danger);"><i data-lucide="file-text" style="width:20px;"></i></div>
                <div>
                    <h4>Format Jurnal Harian</h4>
                    <div class="meta"><span><i data-lucide="book" style="width:12px;"></i> Semua Mapel</span><span><i data-lucide="file" style="width:12px;"></i> XLSX</span><span><i data-lucide="hard-drive" style="width:12px;"></i> 180 KB</span></div>
                </div>
            </div>
            <a href="#" class="download-btn" onclick="alert('Demo: mengunduh template');return false;"><i data-lucide="download" style="width:16px;"></i> Download</a>
        </div>
        <div class="download-item">
            <div class="download-info">
                <div class="icon-box" style="background:#6366f115;color:#6366f1;"><i data-lucide="file-text" style="width:20px;"></i></div>
                <div>
                    <h4>Template Soal & Kisi-Kisi</h4>
                    <div class="meta"><span><i data-lucide="book" style="width:12px;"></i> Semua Mapel</span><span><i data-lucide="file" style="width:12px;"></i> DOCX</span><span><i data-lucide="hard-drive" style="width:12px;"></i> 420 KB</span></div>
                </div>
            </div>
            <a href="#" class="download-btn" onclick="alert('Demo: mengunduh template');return false;"><i data-lucide="download" style="width:16px;"></i> Download</a>
        </div>
    </div>
</div>

<div class="modern-card" style="margin-top:1.25rem;">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1rem;">
        <h4 style="font-size:1rem;font-weight:700;"><i data-lucide="clock" style="width:18px;color:var(--primary);"></i> Riwayat Download</h4>
    </div>
    <div class="table-wrapper">
        <table>
            <thead><tr><th>Template</th><th>Tanggal</th><th>Ukuran</th></tr></thead>
            <tbody>
                <tr><td>Template RPP Merdeka</td><td>22 Mei 2026</td><td>245 KB</td></tr>
                <tr><td>Panduan Penyusunan ATP</td><td>19 Mei 2026</td><td>1.2 MB</td></tr>
                <tr><td>Format Jurnal Harian</td><td>15 Mei 2026</td><td>180 KB</td></tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
