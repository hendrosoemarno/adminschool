@extends('layouts.app')

@section('title', 'Siswa Alert - AI Learning')
@section('page_header', 'Siswa Butuh Perhatian (Alert)')
@section('page_subtitle', 'Daftar siswa dengan nilai topik di bawah KKM per mata pelajaran.')

@section('content')
@if(isset($error))
<div class="modern-card" style="border-left:4px solid var(--danger);padding:2rem;text-align:center;">
    <p class="text-rose-600 font-bold">{{ $error }}</p>
</div>
@else

<div class="modern-card" style="margin-bottom:2rem;">
    <p class="text-slate-500">Sekolah: <strong>{{ $school->school_name }}</strong> — KKM: 70</p>
</div>

@forelse($subjectSections as $prefix => $section)
    @if(empty($section['students']))
        @continue
    @endif

    <div class="modern-card" style="margin-bottom:2rem; border-left:4px solid {{ $loop->first ? 'var(--success)' : 'var(--primary)' }};">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem;">
            <div>
                <h3 class="text-slate-800 font-bold">{{ $section['name'] }}</h3>
                <p class="text-xs text-slate-500 mt-1">{{ count($section['students']) }} siswa dengan topik di bawah KKM ({{ $section['kkm'] }})</p>
            </div>
            <span class="badge-{{ $loop->first ? 'success' : 'primary' }}" style="font-size:11px;">{{ $prefix }}</span>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Nama Siswa</th>
                        @foreach($section['topics'] ?? [] as $topicName)
                            <th style="text-align:center; font-size:11px;">{{ $topicName }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($section['students'] as $st)
                    <tr>
                        <td class="font-bold">{{ $st['name'] }}</td>
                        @foreach($section['topics'] ?? [] as $topicName)
                            @php
                                $score = $st['topics'][$topicName] ?? '-';
                                $isRed = is_numeric($score) && $score < $section['kkm'];
                            @endphp
                            <td style="text-align:center; font-weight:800; {{ $isRed ? 'color:#dc2626;' : 'color:#059669;' }}">
                                {{ is_numeric($score) ? number_format($score, 1) : '-' }}
                            </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@empty
<div class="modern-card" style="padding:3rem;text-align:center;">
    <p class="text-slate-500 font-bold">Semua siswa berada di atas KKM.</p>
</div>
@endforelse

<div style="margin-top:2rem;">
    <a href="/principal/dashboard" class="text-indigo-600 font-bold text-sm" style="text-decoration:none;">&larr; Kembali ke Dashboard</a>
</div>
@endif
@endsection