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
                @forelse($alertData as $code => $data)
                <tr>
                    <td class="font-bold">{{ $data['name'] }}</td>
                    <td style="text-align: center; color: #ef4444; font-weight: 800;">{{ number_format($data['total'] / $data['count'], 1) }}</td>
                    <td style="text-align: center;">{{ number_format($data['kkm'], 1) }}</td>
                    <td>{{ $data['quiz_name'] }}</td>
                    <td>{{ $data['quiz_date'] }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 2rem;">Semua nilai Anda sudah di atas KKM. Pertahankan!</td>
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
