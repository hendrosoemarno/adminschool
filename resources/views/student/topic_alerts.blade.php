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
                @forelse($topicAlerts as $alert)
                <tr>
                    <td>{{ $alert['quiz_name'] }}</td>
                    <td>{{ $alert['quiz_date'] }}</td>
                    <td class="font-bold">{{ $alert['mapel'] }}</td>
                    <td>{{ $alert['topic'] }}</td>
                    <td style="text-align: center; color: #ef4444; font-weight: 800;">{{ $alert['score'] }}</td>
                    <td style="text-align: center;">{{ number_format($alert['kkm'], 1) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 2rem;">Tidak ada topik yang nilainya di bawah KKM.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div style="margin-top: 2rem;">
    <a href="/student/dashboard" class="text-indigo-600 font-bold text-sm" style="text-decoration:none;">&larr; Kembali ke Profil Kompetensi</a>
</div>
@endsection
