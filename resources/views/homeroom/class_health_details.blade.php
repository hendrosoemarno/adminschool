@extends('layouts.app')

@section('title', 'Detail Skor Kesehatan Kelas - AI Learning')
@section('page_header', 'Analisis Class Health Score')
@section('page_subtitle', 'Penjelasan metodologi dan kalkulasi skor kesehatan kelas XII IPA 1.')

@section('content')
<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
    <div class="modern-card">
        <h3 class="text-slate-800 font-bold mb-6">Metodologi Skor</h3>
        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
            <div class="glass" style="padding: 1.25rem; border-radius: 20px;">
                <p class="font-bold text-indigo-600 mb-1">1. Partisipasi (40%)</p>
                <p class="text-sm text-slate-500">Persentase siswa yang mengikuti seluruh kuis wajib.</p>
            </div>
            <div class="glass" style="padding: 1.25rem; border-radius: 20px;">
                <p class="font-bold text-emerald-600 mb-1">2. Rata-rata Kompetensi (40%)</p>
                <p class="text-sm text-slate-500">Rata-rata nilai seluruh mata pelajaran terhadap KKM.</p>
            </div>
            <div class="glass" style="padding: 1.25rem; border-radius: 20px;">
                <p class="font-bold text-rose-600 mb-1">3. Laju Intervensi (-20%)</p>
                <p class="text-sm text-slate-500">Pengurang skor berdasarkan jumlah siswa di bawah standar.</p>
            </div>
        </div>
    </div>

    <div class="modern-card">
        <h3 class="text-slate-800 font-bold mb-6">Kalkulasi Saat Ini</h3>
        <div style="text-align: center; padding: 2rem 0;">
            <div class="text-5xl font-bold text-indigo-600 mb-2">82.5</div>
            <p class="badge-success" style="display: inline-block;">KONDISI PRIMA</p>
        </div>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Komponen</th>
                        <th>Nilai</th>
                        <th>Bobot</th>
                        <th>Skor Akhir</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Partisipasi</td>
                        <td>98%</td>
                        <td>40%</td>
                        <td>39.2</td>
                    </tr>
                    <tr>
                        <td>Kompetensi</td>
                        <td>84.0</td>
                        <td>40%</td>
                        <td>33.6</td>
                    </tr>
                    <tr>
                        <td>Intervensi</td>
                        <td>12%</td>
                        <td>-20%</td>
                        <td>9.7</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div style="margin-top: 2rem;">
    <a href="/homeroom/dashboard" class="text-indigo-600 font-bold text-sm" style="text-decoration:none;">&larr; Kembali ke Dashboard Wali Kelas</a>
</div>
@endsection
