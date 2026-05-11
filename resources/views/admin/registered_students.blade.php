@extends('layouts.app')

@section('title', 'Daftar Siswa Terdaftar - AI Learning')
@section('page_header', 'Manajemen Data Siswa')
@section('page_subtitle', 'Seluruh siswa yang terdaftar dalam ekosistem AI Learning di berbagai sekolah.')

@section('content')
<div class="modern-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h3 class="text-slate-800 font-bold">Data Siswa Aktif</h3>
        <div style="display: flex; gap: 0.75rem;">
            <input type="text" placeholder="Cari NISN atau Nama..." style="padding: 0.5rem 1rem; border-radius: 12px; border: 1px solid var(--border); font-size: 14px; width: 250px;">
            <button class="btn-indigo" style="padding: 0.5rem 1rem;"><i data-lucide="filter" style="width: 16px;"></i> Filter</button>
        </div>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Nama Lengkap</th>
                    <th>NISN</th>
                    <th>Sekolah</th>
                    <th>Tingkat / Kelas</th>
                    <th>Status Moodle</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="font-bold">Aditama Putra</td>
                    <td>20210001</td>
                    <td>SMA Negeri 1 Jakarta</td>
                    <td><span class="badge-primary">XII IPA 1</span></td>
                    <td><span class="badge-success">ACTIVE</span></td>
                    <td><button class="text-indigo-600" style="border:none; background:none; cursor:pointer; font-weight:700;">Profil</button></td>
                </tr>
                <tr>
                    <td class="font-bold">Bela Cantika</td>
                    <td>20210002</td>
                    <td>SMA Negeri 1 Jakarta</td>
                    <td><span class="badge-primary">XII IPA 1</span></td>
                    <td><span class="badge-success">ACTIVE</span></td>
                    <td><button class="text-indigo-600" style="border:none; background:none; cursor:pointer; font-weight:700;">Profil</button></td>
                </tr>
                <tr>
                    <td class="font-bold">Budi Santoso</td>
                    <td>20210003</td>
                    <td>SMA Kristen 1</td>
                    <td><span class="badge-primary">XII IPA 2</span></td>
                    <td><span class="badge-success">ACTIVE</span></td>
                    <td><button class="text-indigo-600" style="border:none; background:none; cursor:pointer; font-weight:700;">Profil</button></td>
                </tr>
                <tr>
                    <td class="font-bold">Citra Lestari</td>
                    <td>20210004</td>
                    <td>SMAS Al-Azhar</td>
                    <td><span class="badge-primary">X UMUM 5</span></td>
                    <td><span class="badge-success">ACTIVE</span></td>
                    <td><button class="text-indigo-600" style="border:none; background:none; cursor:pointer; font-weight:700;">Profil</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div style="margin-top: 2rem;">
    <a href="/admin/dashboard" class="text-indigo-600 font-bold text-sm" style="text-decoration:none;">&larr; Kembali ke Dashboard</a>
</div>
@endsection
