@extends('layouts.app')

@section('title', 'Laporan Intervensi - AI Learning')
@section('page_header', 'Siswa Butuh Intervensi')
@section('page_subtitle', 'Daftar siswa dengan pencapaian kompetensi di bawah ambang batas (threshold).')

@section('content')
<div class="modern-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h3 class="text-slate-800 font-bold">Analisis Nilai di Bawah Standar</h3>
        <button class="btn-indigo" style="background: #fdf2f8; color: #db2777; border: 1px solid #fbcfe8; box-shadow: none;">
            <i data-lucide="mail" style="width: 16px;"></i> Ingatkan Wali Kelas
        </button>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Nama Siswa</th>
                    <th>Mata Pelajaran</th>
                    <th>Skor</th>
                    <th>Standar (Threshold)</th>
                    <th>Kelas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="font-bold">Budi Santoso</td>
                    <td>Matematika</td>
                    <td class="font-bold text-rose-600">45.0</td>
                    <td>75.0</td>
                    <td>XII IPA 3</td>
                    <td><button class="text-indigo-600" style="border:none; background:none; cursor:pointer; font-weight:700;">Detail Analitik</button></td>
                </tr>
                <tr>
                    <td class="font-bold">Citra Lestari</td>
                    <td>Kimia</td>
                    <td class="font-bold text-rose-600">52.5</td>
                    <td>80.0</td>
                    <td>XII IPA 3</td>
                    <td><button class="text-indigo-600" style="border:none; background:none; cursor:pointer; font-weight:700;">Detail Analitik</button></td>
                </tr>
                <tr>
                    <td class="font-bold">Dedi Kurniawan</td>
                    <td>Fisika</td>
                    <td class="font-bold text-rose-600">58.0</td>
                    <td>80.0</td>
                    <td>XII IPA 2</td>
                    <td><button class="text-indigo-600" style="border:none; background:none; cursor:pointer; font-weight:700;">Detail Analitik</button></td>
                </tr>
                <tr>
                    <td class="font-bold">Eka Wahyuni</td>
                    <td>Biologi</td>
                    <td class="font-bold text-rose-600">61.0</td>
                    <td>75.0</td>
                    <td>XI IPA 1</td>
                    <td><button class="text-indigo-600" style="border:none; background:none; cursor:pointer; font-weight:700;">Detail Analitik</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div style="margin-top: 2rem;">
    <a href="/principal/dashboard" class="text-indigo-600 font-bold text-sm" style="text-decoration:none;">&larr; Kembali ke Dashboard Performa</a>
</div>
@endsection
