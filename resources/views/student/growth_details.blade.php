@extends('layouts.app')

@section('title', 'Riwayat Pertumbuhan Nilai - AI Learning')
@section('page_header', 'Analisis Growth Kompetensi')
@section('page_subtitle', 'Pantau perkembangan nilai Anda dari ujian pertama hingga terakhir.')

@section('content')
<div class="modern-card">
    <h3 class="text-slate-800 font-bold mb-6">Riwayat Skor Pelajaran</h3>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Mata Pelajaran</th>
                    <th style="text-align: center;">Prosentase Pertumbuhan</th>
                    <th style="text-align: center;">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="font-bold">Fisika</td>
                    <td style="text-align: center;" class="text-emerald-600 font-bold">↑ 12.5%</td>
                    <td style="text-align: center;"><span class="badge-success">EXCELLENT</span></td>
                </tr>
                <tr>
                    <td class="font-bold">Matematika</td>
                    <td style="text-align: center;" class="text-emerald-600 font-bold">↑ 8.2%</td>
                    <td style="text-align: center;"><span class="badge-primary">GOOD</span></td>
                </tr>
                <tr>
                    <td class="font-bold">Kimia</td>
                    <td style="text-align: center;" class="text-rose-600 font-bold">↓ 4.5%</td>
                    <td style="text-align: center;"><span class="badge-danger" style="background:#fee2e2; color:#991b1b;">BAD</span></td>
                </tr>
                <tr>
                    <td class="font-bold">B. Inggris</td>
                    <td style="text-align: center;" class="text-emerald-600 font-bold">↑ 5.0%</td>
                    <td style="text-align: center;"><span class="badge-primary">GOOD</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div style="margin-top: 2rem;">
    <a href="/student/dashboard" class="text-indigo-600 font-bold text-sm" style="text-decoration:none;">&larr; Kembali ke Profil Kompetensi</a>
</div>
@endsection
