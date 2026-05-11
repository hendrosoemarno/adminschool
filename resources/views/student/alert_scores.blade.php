@extends('layouts.app')

@section('title', 'Nilai Alert - AI Learning')
@section('page_header', 'Capaian di Bawah KKM')
@section('page_subtitle', 'Mata pelajaran yang membutuhkan perhatian segera untuk mencapai standar kelulusan.')

@section('content')
<div class="modern-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h3 class="text-slate-800 font-bold">Needs Improvement</h3>
        <span class="badge-danger" style="background:#fee2e2; color:#991b1b; padding: 0.5rem 1rem;">URGENT</span>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Mata Pelajaran</th>
                    <th style="text-align: center;">Nilai</th>
                    <th style="text-align: center;">KKM</th>
                    <th>Nama Quiz</th>
                    <th>Tanggal Quiz</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="font-bold">Kimia</td>
                    <td style="text-align: center; color: #ef4444; font-weight: 800;">62.5</td>
                    <td style="text-align: center;">75.0</td>
                    <td>Try Out UTBK #1</td>
                    <td>12 Feb 2026</td>
                </tr>
                <tr>
                    <td class="font-bold">Biologi</td>
                    <td style="text-align: center; color: #ef4444; font-weight: 800;">68.0</td>
                    <td style="text-align: center;">75.0</td>
                    <td>Evaluasi Mingguan</td>
                    <td>05 Feb 2026</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div style="margin-top: 2rem;">
    <a href="/student/dashboard" class="text-indigo-600 font-bold text-sm" style="text-decoration:none;">&larr; Kembali ke Profil Kompetensi</a>
</div>
@endsection
