@extends('layouts.app')

@section('title', 'Alert Topik Spesifik - AI Learning')
@section('page_header', 'Diagnosis Topik di Bawah KKM')
@section('page_subtitle', 'Detail topik spesifik yang belum dikuasai berdasarkan hasil ujian terakhir.')

@section('content')
<div class="modern-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h3 class="text-slate-800 font-bold">Spesifik Topic Failure</h3>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Nama Ujian</th>
                    <th>Tanggal</th>
                    <th>Mata Pelajaran</th>
                    <th>Topik / Micro-skill</th>
                    <th style="text-align: center;">Skor Topik</th>
                    <th style="text-align: center;">KKM</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Try Out UTBK #1</td>
                    <td>12 Feb 2026</td>
                    <td class="font-bold">Kimia</td>
                    <td>Stoikiometri Dasar</td>
                    <td style="text-align: center; color: #ef4444; font-weight: 800;">45.0</td>
                    <td style="text-align: center;">75.0</td>
                </tr>
                <tr>
                    <td>Try Out UTBK #1</td>
                    <td>12 Feb 2026</td>
                    <td class="font-bold">Kimia</td>
                    <td>Laju Reaksi</td>
                    <td style="text-align: center; color: #ef4444; font-weight: 800;">58.0</td>
                    <td style="text-align: center;">75.0</td>
                </tr>
                <tr>
                    <td>Kuis Harian 2</td>
                    <td>05 Feb 2026</td>
                    <td class="font-bold">Fisika</td>
                    <td>Hukum Newton II</td>
                    <td style="text-align: center; color: #ef4444; font-weight: 800;">62.5</td>
                    <td style="text-align: center;">75.0</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div style="margin-top: 2rem;">
    <a href="/student/dashboard" class="text-indigo-600 font-bold text-sm" style="text-decoration:none;">&larr; Kembali ke Profil Kompetensi</a>
</div>
@endsection
