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
                    <th style="text-align: center;">Nilai Awal</th>
                    <th style="text-align: center;">Nilai Akhir</th>
                    <th style="text-align: center;">Prosentase Pertumbuhan</th>
                    <th style="text-align: center;">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($growthData as $g)
                <tr>
                    <td class="font-bold">{{ $g['mapel'] }}</td>
                    <td style="text-align: center;">{{ number_format($g['baseline'], 1) }}</td>
                    <td style="text-align: center;">{{ number_format($g['current'], 1) }}</td>
                    <td style="text-align: center;" class="{{ $g['growth'] >= 0 ? 'text-emerald-600' : 'text-rose-600' }} font-bold">
                        {{ $g['growth'] >= 0 ? '↑' : '↓' }} {{ number_format(abs($g['growth']), 1) }}%
                    </td>
                    <td style="text-align: center;">
                        @if($g['status'] == 'EXCELLENT')
                            <span class="badge-success">EXCELLENT</span>
                        @elseif($g['status'] == 'GOOD')
                            <span class="badge-primary">GOOD</span>
                        @else
                            <span class="badge-danger" style="background:#fee2e2; color:#991b1b;">BAD</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 2rem;">Belum ada data growth. Kerjakan minimal 2 kuis untuk melihat perkembangan.</td>
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
