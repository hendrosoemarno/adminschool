@extends('layouts.app')

@section('title', 'Daftar Mapping Kompetensi - AI Learning')
@section('page_header', 'Manajemen Pemetaan Kompetensi')
@section('page_subtitle', 'Kelola hubungan antara kategori soal Moodle dengan standar kompetensi AI Learning.')

@section('content')
<div class="modern-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h3 class="text-slate-800 font-bold">Pemetaan Aktif</h3>
        <button class="btn-indigo" style="padding: 0.5rem 1rem;"><i data-lucide="refresh-cw" style="width: 16px;"></i> Scan Kategori Baru</button>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Moodle Category</th>
                    <th>Subyek</th>
                    <th>Micro-skill Mapped</th>
                    <th>Tahun Ajaran</th>
                    <th>Akurasi</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="font-bold">FIS-MC-01-Dinamika</td>
                    <td>Fisika</td>
                    <td><span class="badge-primary">Hukum Newton</span></td>
                    <td>2023/2024</td>
                    <td class="font-bold text-emerald-600">100%</td>
                    <td><span class="badge-success">MAPPED</span></td>
                </tr>
                <tr>
                    <td class="font-bold">MAT-MC-05-Logaritma</td>
                    <td>Matematika</td>
                    <td><span class="badge-primary">Sifat Logaritma</span></td>
                    <td>2023/2024</td>
                    <td class="font-bold text-emerald-600">100%</td>
                    <td><span class="badge-success">MAPPED</span></td>
                </tr>
                <tr>
                    <td class="font-bold">KIM-03-Stoikiometri</td>
                    <td>Kimia</td>
                    <td><span class="badge-primary">Konsep Mol</span></td>
                    <td>2023/2024</td>
                    <td class="font-bold text-amber-600">85%</td>
                    <td><span class="badge-warning">REVIEW REQ</span></td>
                </tr>
                <tr>
                    <td class="font-bold">BIO-MC-02-Sel</td>
                    <td>Biologi</td>
                    <td><span class="badge-primary">Struktur Sel</span></td>
                    <td>2023/2024</td>
                    <td class="font-bold text-emerald-600">100%</td>
                    <td><span class="badge-success">MAPPED</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div style="margin-top: 2rem;">
    <a href="/admin/dashboard" class="text-indigo-600 font-bold text-sm" style="text-decoration:none;">&larr; Kembali ke Dashboard</a>
</div>
@endsection
