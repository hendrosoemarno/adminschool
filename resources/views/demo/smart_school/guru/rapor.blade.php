@extends('layouts.smart_school')

@section('title', 'Cetak Rapor - Smart School')
@section('page_header', 'Cetak Rapor')
@section('page_subtitle', 'Preview dan cetak rapor siswa per semester.')
@section('breadcrumb')
<a href="{{ url('/demo/smart-school/guru') }}">Guru</a> / <a href="{{ url('/demo/smart-school/guru/rapor') }}">Laporan</a> / <span>Cetak Rapor</span>
@endsection

@section('styles')
<style>
    .filter-bar { display:flex; gap:1rem; align-items:center; flex-wrap:wrap; margin-bottom:1.5rem; }
    .filter-bar select { padding:0.6rem 1rem; border:1px solid var(--border); border-radius:12px; font-size:0.85rem; background:var(--bg-card); color:var(--text-main); outline:none; }
    .rapor-preview { max-width:800px; margin:0 auto; }
    .rapor-header { text-align:center; padding-bottom:1.5rem; border-bottom:2px solid var(--border); margin-bottom:1.5rem; }
    .rapor-header h2 { font-size:1.1rem; font-weight:800; color:var(--primary); margin-bottom:0.25rem; }
    .rapor-header .sub { font-size:0.8rem; color:var(--text-sub); }
    .rapor-info { display:grid; grid-template-columns:1fr 1fr; gap:0.5rem 2rem; font-size:0.85rem; margin-bottom:1.5rem; }
    .rapor-info .label { color:var(--text-sub); font-weight:600; }
    .rapor-info .value { font-weight:700; }
    .catatan-area { width:100%; min-height:100px; padding:0.75rem 1rem; border:1px solid var(--border); border-radius:12px; font-size:0.85rem; font-family:'Inter',sans-serif; background:var(--bg-card); color:var(--text-main); outline:none; resize:vertical; margin-top:1rem; }
    .catatan-area:focus { border-color:var(--primary); }
    .predikat-badge { display:inline-block; padding:0.15rem 0.5rem; border-radius:6px; font-size:0.7rem; font-weight:700; }
    .predikat-a { background:#05966915; color:var(--success); }
    .predikat-b { background:#4f46e515; color:var(--primary); }
    .predikat-c { background:#d9770615; color:var(--warning); }
    .predikat-d { background:#dc262615; color:var(--danger); }
</style>
@endsection

@section('content')
<div class="modern-card">
    <div class="filter-bar">
        <i data-lucide="filter" style="width:18px;color:var(--text-sub);"></i>
        <select>
            <option>XII IPA 1</option>
            <option>XII IPA 2</option>
            <option>XI IPA 1</option>
            <option>XI IPA 2</option>
            <option>X IPA 1</option>
        </select>
        <select>
            <option>Semester Ganjil 2025/2026</option>
            <option>Semester Genap 2025/2026</option>
            <option>Semester Ganjil 2026/2027</option>
        </select>
        <select>
            <option value="">-- Pilih Siswa --</option>
            <option>Ahmad Fauzi</option>
            <option>Budi Santoso</option>
            <option>Citra Dewi</option>
            <option>Dian Permata</option>
            <option>Eko Prasetyo</option>
        </select>
        <button class="btn-indigo" onclick="alert('Demo: tampilkan rapor');"><i data-lucide="search" style="width:16px;"></i> Tampilkan</button>
    </div>
</div>

<div class="modern-card" style="margin-top:1.25rem;">
    <div class="rapor-preview">
        <div class="rapor-header">
            <h2>LAPORAN HASIL BELAJAR SISWA</h2>
            <div class="sub">SMA NEGERI 1 SMART SCHOOL — TAHUN PELAJARAN 2025/2026</div>
        </div>

        <div class="rapor-info">
            <div><span class="label">Nama Siswa</span><br><span class="value">Citra Dewi</span></div>
            <div><span class="label">NISN</span><br><span class="value">0028123456</span></div>
            <div><span class="label">Kelas</span><br><span class="value">XII IPA 1</span></div>
            <div><span class="label">Semester</span><br><span class="value">Genap 2025/2026</span></div>
        </div>

        <h4 style="font-size:0.9rem;font-weight:700;margin-bottom:0.75rem;">Nilai Akademik</h4>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr><th>No</th><th>Mata Pelajaran</th><th>Nilai Angka</th><th>Predikat</th><th>Deskripsi</th></tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td><strong>Matematika Wajib</strong></td>
                        <td>88</td>
                        <td><span class="predikat-badge predikat-a">A</span></td>
                        <td style="font-size:0.75rem;color:var(--text-sub);">Sangat baik dalam menguasai konsep barisan, deret, dan matriks.</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><strong>Matematika Peminatan</strong></td>
                        <td>82</td>
                        <td><span class="predikat-badge predikat-b">B</span></td>
                        <td style="font-size:0.75rem;color:var(--text-sub);">Baik dalam trigonometri lanjutan, perlu latihan limit fungsi.</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td><strong>Fisika</strong></td>
                        <td>78</td>
                        <td><span class="predikat-badge predikat-b">B</span></td>
                        <td style="font-size:0.75rem;color:var(--text-sub);">Cukup baik dalam mekanika, perlu peningkatan pada termodinamika.</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td><strong>Kimia</strong></td>
                        <td>92</td>
                        <td><span class="predikat-badge predikat-a">A</span></td>
                        <td style="font-size:0.75rem;color:var(--text-sub);">Sangat baik dalam memahami konsep kimia organik dan anorganik.</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td><strong>Biologi</strong></td>
                        <td>85</td>
                        <td><span class="predikat-badge predikat-a">A</span></td>
                        <td style="font-size:0.75rem;color:var(--text-sub);">Baik dalam biologi sel dan genetika. Aktif dalam praktikum.</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td><strong>Bahasa Indonesia</strong></td>
                        <td>80</td>
                        <td><span class="predikat-badge predikat-b">B</span></td>
                        <td style="font-size:0.75rem;color:var(--text-sub);">Cukup baik, perlu perbaikan pada karya tulis ilmiah.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div style="margin-top:1.5rem;">
            <label style="font-size:0.8rem;font-weight:700;color:var(--text-sub);display:block;margin-bottom:0.3rem;">Catatan Wali Kelas</label>
            <textarea class="catatan-area" placeholder="Tulis catatan wali kelas...">Citra Dewi adalah siswa yang rajin dan berprestasi. Ia aktif dalam diskusi kelas dan mengerjakan tugas tepat waktu. Pertahankan prestasinya dan tingkatkan lagi kemampuan di bidang Fisika. Secara umum, perkembangan akademiknya sangat memuaskan.</textarea>
        </div>

        <div style="display:flex; gap:0.75rem; justify-content:flex-end; margin-top:1.5rem; padding-top:1.5rem; border-top:1px solid var(--border);">
            <button class="btn-outline-sm" onclick="alert('Demo: cetak rapor massal');"><i data-lucide="printer" style="width:16px;"></i> Cetak Massal</button>
            <button class="btn-indigo" onclick="alert('Demo: cetak PDF rapor');"><i data-lucide="file-text" style="width:16px;"></i> Cetak PDF</button>
        </div>
    </div>
</div>

<div class="modern-card" style="margin-top:1.25rem;">
    <div style="display:flex;align-items:center;gap:0.75rem;">
        <i data-lucide="history" style="width:18px;color:var(--text-sub);"></i>
        <span style="font-size:0.85rem;color:var(--text-sub);">Riwayat cetak terakhir: 20 Mei 2026 — Cetak Massal XII IPA 1 (32 siswa)</span>
        <button class="btn-outline-sm" style="margin-left:auto;" onclick="alert('Demo: lihat riwayat cetak');">Lihat Riwayat</button>
    </div>
</div>
@endsection
