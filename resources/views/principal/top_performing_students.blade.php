@extends('layouts.app')

@section('title', 'Laporan Pencapaian Siswa - AI Learning')
@section('page_header', 'Siswa Melampaui Target')
@section('page_subtitle', 'Daftar siswa dengan pencapaian di atas seluruh target benchmark (Nasional, Provinsi, Kota, Sekolah).')

@section('content')
<div class="modern-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <div>
            <h3 class="text-slate-800 font-bold">Elite Performers</h3>
            <div style="margin-top: 0.5rem; display: flex; align-items: center; gap: 0.75rem;">
                <label class="text-xs font-bold text-slate-500 uppercase">Lihat Target:</label>
                <select style="padding: 0.4rem 1rem; border-radius: 10px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main); font-size: 13px; min-width: 180px;">
                    <option>Melampaui Semua Target</option>
                    <option>Melampaui Target Nasional</option>
                    <option>Melampaui Target Provinsi</option>
                    <option>Melampaui Target Kota</option>
                    <option>Melampaui Target Sekolah</option>
                </select>
            </div>
        </div>
        <button class="btn-indigo" style="background: #ecfdf5; color: #059669; border: 1px solid #a7f3d0; box-shadow: none;">
            <i data-lucide="award" style="width: 16px;"></i> Berikan Lencana
        </button>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Mata Pelajaran</th>
                    <th>Skor Aktual</th>
                    <th>Target Sekolah</th>
                    <th>Target Kota</th>
                    <th>Target Provinsi</th>
                    <th>Target Nasional</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="font-bold">Aditama Putra</td>
                    <td>XII IPA 1</td>
                    <td>Fisika</td>
                    <td class="font-bold text-emerald-600">96.5</td>
                    <td>74.5</td>
                    <td>75.0</td>
                    <td>78.0</td>
                    <td>80.0</td>
                    <td><span class="badge-success">EXCEEDED ALL</span></td>
                </tr>
                <tr>
                    <td class="font-bold">Bela Cantika</td>
                    <td>XII IPA 1</td>
                    <td>Matematika</td>
                    <td class="font-bold text-emerald-600">94.0</td>
                    <td>70.0</td>
                    <td>71.0</td>
                    <td>72.5</td>
                    <td>75.0</td>
                    <td><span class="badge-success">EXCEEDED ALL</span></td>
                </tr>
                <tr>
                    <td class="font-bold">Citra Kirana</td>
                    <td>XI IPA 2</td>
                    <td>Biologi</td>
                    <td class="font-bold text-emerald-600">92.8</td>
                    <td>72.0</td>
                    <td>73.5</td>
                    <td>75.0</td>
                    <td>78.0</td>
                    <td><span class="badge-success">EXCEEDED ALL</span></td>
                </tr>
                <tr>
                    <td class="font-bold">Doni Salmanan</td>
                    <td>XII IPA 3</td>
                    <td>Kimia</td>
                    <td class="font-bold text-emerald-600">89.5</td>
                    <td>72.0</td>
                    <td>73.5</td>
                    <td>75.0</td>
                    <td>78.0</td>
                    <td><span class="badge-success">EXCEEDED ALL</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div style="margin-top: 2rem;">
    <a href="/principal/dashboard" class="text-indigo-600 font-bold text-sm" style="text-decoration:none;">&larr; Kembali ke Dashboard Performa</a>
</div>
@endsection
