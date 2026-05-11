@extends('layouts.app')

@section('title', 'Prestasi Siswa Kelas - AI Learning')
@section('page_header', 'Laporan Prestasi Kelas')
@section('page_subtitle', 'Daftar siswa XII IPA 1 yang berhasil melampaui target benchmark.')

@section('content')
<div class="modern-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h3 class="text-slate-800 font-bold">Elite Students Mastery</h3>
        <div style="display: flex; gap: 0.5rem;">
            <button class="btn-indigo" style="background: #ecfdf5; color: #059669; border: 1px solid #a7f3d0; box-shadow: none;">
                <i data-lucide="award" style="width: 16px;"></i> Sertifikat Digital
            </button>
        </div>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Nama Siswa</th>
                    <th>MTK</th>
                    <th>FIS</th>
                    <th>KIM</th>
                    <th>BIO</th>
                    <th>BIN</th>
                    <th>BIG</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="font-bold">Aditama Putra</td>
                    <td style="color: #059669; font-weight: 800;">96</td>
                    <td style="color: #059669; font-weight: 800;">92</td>
                    <td style="color: #059669; font-weight: 800;">95</td>
                    <td style="color: #059669; font-weight: 800;">88</td>
                    <td style="color: #059669; font-weight: 800;">90</td>
                    <td style="color: #059669; font-weight: 800;">94</td>
                </tr>
                <tr>
                    <td class="font-bold">Ananda Putri</td>
                    <td style="color: #059669; font-weight: 800;">92</td>
                    <td style="color: #059669; font-weight: 800;">88</td>
                    <td style="color: #059669; font-weight: 800;">90</td>
                    <td>82</td>
                    <td style="color: #059669; font-weight: 800;">92</td>
                    <td>85</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div style="margin-top: 2rem;">
    <a href="/homeroom/dashboard" class="text-indigo-600 font-bold text-sm" style="text-decoration:none;">&larr; Kembali ke Dashboard Wali Kelas</a>
</div>
@endsection
