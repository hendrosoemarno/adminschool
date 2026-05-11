@extends('layouts.app')

@section('title', 'Diagnosis Topik Tersulit - AI Learning')
@section('page_header', 'Diagnosis Performa Topik')
@section('page_subtitle', 'Daftar siswa dengan penguasaan topik di bawah KKM (75).')

@section('content')
<div class="modern-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <div>
            <h3 class="text-slate-800 font-bold">Analisis Ketuntasan Belajar</h3>
            <div style="margin-top: 0.5rem; display: flex; align-items: center; gap: 0.75rem;">
                <label class="text-xs font-bold text-slate-500 uppercase">Pilih Pelaksanaan:</label>
                <select style="padding: 0.4rem 1rem; border-radius: 10px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main); font-size: 13px; min-width: 250px;">
                    <option>Try Out UTBK #1 (12 Feb 2026)</option>
                    <option>Kuis Harian Dinamika (05 Feb 2026)</option>
                    <option>Evaluasi Termo (28 Jan 2026)</option>
                </select>
            </div>
        </div>
        <button class="btn-indigo" style="background: #fff1f2; color: #e11d48; border: 1px solid #fecdd3; box-shadow: none;">
            <i data-lucide="file-text" style="width: 16px;"></i> Buat Modul Remedial
        </button>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Nama Siswa</th>
                    <th style="text-align: center;">Kinematika</th>
                    <th style="text-align: center;">Dinamika</th>
                    <th style="text-align: center;">Energi</th>
                    <th style="text-align: center;">Termodinamika</th>
                    <th style="text-align: center;">Fluida</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="font-bold">Bela Cantika</td>
                    <td style="text-align: center;">78</td>
                    <td style="text-align: center; color: #ef4444; font-weight: 800;">65</td>
                    <td style="text-align: center;">82</td>
                    <td style="text-align: center; color: #ef4444; font-weight: 800;">52</td>
                    <td style="text-align: center;">76</td>
                </tr>
                <tr>
                    <td class="font-bold">Fajar Nugraha</td>
                    <td style="text-align: center; color: #ef4444; font-weight: 800;">58</td>
                    <td style="text-align: center; color: #ef4444; font-weight: 800;">60</td>
                    <td style="text-align: center; color: #ef4444; font-weight: 800;">45</td>
                    <td style="text-align: center; color: #ef4444; font-weight: 800;">40</td>
                    <td style="text-align: center; color: #ef4444; font-weight: 800;">55</td>
                </tr>
                <tr>
                    <td class="font-bold">Gita Savitri</td>
                    <td style="text-align: center;">88</td>
                    <td style="text-align: center;">85</td>
                    <td style="text-align: center;">90</td>
                    <td style="text-align: center; color: #ef4444; font-weight: 800;">68</td>
                    <td style="text-align: center;">82</td>
                </tr>
                <tr>
                    <td class="font-bold">Rizky Ramadhan</td>
                    <td style="text-align: center; color: #ef4444; font-weight: 800;">72</td>
                    <td style="text-align: center;">76</td>
                    <td style="text-align: center;">80</td>
                    <td style="text-align: center; color: #ef4444; font-weight: 800;">48</td>
                    <td style="text-align: center; color: #ef4444; font-weight: 800;">62</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div style="margin-top: 2rem;">
    <a href="/teacher/dashboard" class="text-indigo-600 font-bold text-sm" style="text-decoration:none;">&larr; Kembali ke Dashboard Guru</a>
</div>
@endsection
