@extends('layouts.app')

@section('title', 'Siswa Tidak Hadir Ujian - AI Learning')
@section('page_header', 'Laporan Ketidakhadiran')
@section('page_subtitle', 'Daftar siswa XII IPA 1 yang tidak mengikuti kuis/ujian aktif.')

@section('content')
<div class="modern-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h3 class="text-slate-800 font-bold">Monitor Kehadiran Kuis</h3>
        <button class="btn-indigo" style="background: #fdf2f8; color: #db2777; border: 1px solid #fbcfe8; box-shadow: none;">
            <i data-lucide="bell" style="width: 16px;"></i> Ingatkan Siswa
        </button>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Nama Siswa</th>
                    <th>NISN</th>
                    <th>Kuis / Tryout</th>
                    <th>Mata Pelajaran</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="font-bold">Rizky Ramadhan</td>
                    <td>20210045</td>
                    <td>Try Out UTBK #1</td>
                    <td>Fisika</td>
                    <td><span class="badge-danger" style="background:#fee2e2; color:#991b1b;">TIDAK HADIR</span></td>
                </tr>
                <tr>
                    <td class="font-bold">Anisa Putri</td>
                    <td>20210012</td>
                    <td>Kuis Dinamika</td>
                    <td>Fisika</td>
                    <td><span class="badge-danger" style="background:#fee2e2; color:#991b1b;">TIDAK HADIR</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div style="margin-top: 2rem;">
    <a href="/homeroom/dashboard" class="text-indigo-600 font-bold text-sm" style="text-decoration:none;">&larr; Kembali ke Dashboard Wali Kelas</a>
</div>
@endsection
