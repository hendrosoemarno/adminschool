@extends('layouts.app')

@section('title', 'Nilai Excellent - AI Learning')
@section('page_header', 'Capaian di Atas Target')
@section('page_subtitle', 'Daftar mata pelajaran dan topik di mana Anda melampaui target benchmark.')

@section('content')
<div class="modern-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h3 class="text-slate-800 font-bold">Excellent Performance</h3>
        <span class="badge-success" style="padding: 0.5rem 1rem;">MAINTAIN THIS!</span>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Mata Pelajaran</th>
                    <th style="text-align: center;">Skor Anda</th>
                    <th style="text-align: center;">Target Sekolah</th>
                </tr>
            </thead>
            <tbody>
                @forelse($excellentData as $courseName => $data)
                <tr>
                    <td class="font-bold">{{ $courseName }}</td>
                    <td style="text-align: center; color: #059669; font-weight: 800;">{{ number_format($data['score'], 1) }}</td>
                    <td style="text-align: center;">{{ $data['target'] }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" style="text-align: center; padding: 2rem;">Belum ada Mata Pelajaran yang mencapai atau melampaui target sekolah. Teruslah berlatih!</td>
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
