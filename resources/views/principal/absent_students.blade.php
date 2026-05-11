@extends('layouts.app')

@section('title', 'Laporan Ketidakhadiran - AI Learning')
@section('page_header', 'Laporan Siswa Tidak Hadir')
@section('page_subtitle', 'Daftar siswa yang tidak berpartisipasi dalam ujian/kuis aktif.')

@section('content')
<div class="modern-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h3 class="text-slate-800 font-bold">Data Ketidakhadiran Real-time</h3>
        <div style="display: flex; gap: 0.75rem;">
            <button class="btn-indigo" style="background: white; color: var(--primary); border: 1px solid var(--primary); box-shadow: none;">
                <i data-lucide="download" style="width: 16px;"></i> Ekspor PDF
            </button>
        </div>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Wali Kelas</th>
                    <th>Mata Pelajaran</th>
                    <th>Kuis / Ujian</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="font-bold">Rizky Ramadhan</td>
                    <td>XII IPA 1</td>
                    <td>Drs. Hendro Soemarno</td>
                    <td>Fisika</td>
                    <td>Try Out UTBK #1</td>
                    <td><span class="badge-danger" style="background: #fee2e2; color: #991b1b; padding: 4px 12px; border-radius: 99px; font-size: 10px; font-weight: 700;">TIDAK HADIR</span></td>
                </tr>
                <tr>
                    <td class="font-bold">Anisa Putri</td>
                    <td>XII IPA 1</td>
                    <td>Drs. Hendro Soemarno</td>
                    <td>Fisika</td>
                    <td>Try Out UTBK #1</td>
                    <td><span class="badge-danger" style="background: #fee2e2; color: #991b1b; padding: 4px 12px; border-radius: 99px; font-size: 10px; font-weight: 700;">TIDAK HADIR</span></td>
                </tr>
                <tr>
                    <td class="font-bold">Fajar Nugraha</td>
                    <td>XII IPA 2</td>
                    <td>Ibu Siti Aminah</td>
                    <td>Matematika</td>
                    <td>Latihan Aljabar</td>
                    <td><span class="badge-danger" style="background: #fee2e2; color: #991b1b; padding: 4px 12px; border-radius: 99px; font-size: 10px; font-weight: 700;">TIDAK HADIR</span></td>
                </tr>
                <tr>
                    <td class="font-bold">Gita Savitri</td>
                    <td>X IPS 3</td>
                    <td>Bpk. Bambang</td>
                    <td>Ekonomi</td>
                    <td>Kuis Dasar Akuntansi</td>
                    <td><span class="badge-danger" style="background: #fee2e2; color: #991b1b; padding: 4px 12px; border-radius: 99px; font-size: 10px; font-weight: 700;">TIDAK HADIR</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div style="margin-top: 2rem;">
    <a href="/principal/dashboard" class="text-indigo-600 font-bold text-sm" style="text-decoration:none;">&larr; Kembali ke Dashboard Performa</a>
</div>
@endsection
