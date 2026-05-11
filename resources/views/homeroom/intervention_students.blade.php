@extends('layouts.app')

@section('title', 'Siswa Butuh Perhatian - AI Learning')
@section('page_header', 'Laporan Intervensi Kelas')
@section('page_subtitle', 'Analisis nilai siswa di bawah KKM untuk seluruh mata pelajaran.')

@section('content')
<div class="modern-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <div>
            <h3 class="text-slate-800 font-bold">Data Nilai di Bawah KKM</h3>
            <div style="margin-top: 1rem; display: flex; gap: 1rem; align-items: center;">
                <select style="padding: 0.4rem 1rem; border-radius: 10px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main); font-size: 13px;">
                    <option>Semua Mata Pelajaran</option>
                    <option>Matematika</option>
                    <option>Fisika</option>
                </select>
                <select style="padding: 0.4rem 1rem; border-radius: 10px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main); font-size: 13px;">
                    <option>Try Out UTBK #1 (12 Feb 2026)</option>
                    <option>Kuis Harian (05 Feb 2026)</option>
                </select>
            </div>
        </div>
        <button class="btn-indigo">
            <i data-lucide="download" style="width: 16px;"></i> Laporan Orang Tua
        </button>
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
                    <td class="font-bold">Bela Cantika</td>
                    <td style="color: #ef4444; font-weight: 800;">65</td>
                    <td style="color: #ef4444; font-weight: 800;">52</td>
                    <td>78</td>
                    <td>82</td>
                    <td>80</td>
                    <td>85</td>
                </tr>
                <tr>
                    <td class="font-bold">Rizky Ramadhan</td>
                    <td>78</td>
                    <td style="color: #ef4444; font-weight: 800;">58</td>
                    <td style="color: #ef4444; font-weight: 800;">62</td>
                    <td>76</td>
                    <td>82</td>
                    <td>80</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div style="margin-top: 2rem;">
    <a href="/homeroom/dashboard" class="text-indigo-600 font-bold text-sm" style="text-decoration:none;">&larr; Kembali ke Dashboard Wali Kelas</a>
</div>
@endsection
