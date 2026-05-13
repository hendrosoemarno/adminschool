@extends('layouts.app')

@section('title', 'Kelompok Alert - AI Learning')
@section('page_header', 'Kelompok Topik Alert')
@section('page_subtitle', 'Kelompok topik yang memiliki siswa dengan nilai di bawah KKM.')

@section('content')
@if(isset($error))
<div class="modern-card" style="border-left:4px solid var(--danger);padding:2rem;text-align:center;">
    <p class="text-rose-600 font-bold">{{ $error }}</p>
</div>
@else

<div class="modern-card" style="margin-bottom:2rem;">
    <p class="text-slate-500">Sekolah: <strong>{{ $school->school_name }}</strong> — KKM: {{ $kkmScore }}</p>
</div>

@forelse($groups as $prefix => $section)
    <div class="modern-card" style="margin-bottom:2rem; border-left:4px solid var(--danger);">
        <h3 class="text-slate-800 font-bold mb-4">{{ $section['name'] }}</h3>

        @foreach($section['groups'] as $topicName => $students)
        <div style="margin-bottom:1.5rem; padding:1rem; background:#fef2f2; border-radius:12px;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:0.75rem;">
                <h4 class="font-bold text-rose-700">{{ $topicName }}</h4>
                <span class="text-xs text-slate-500">{{ count($students) }} siswa</span>
            </div>
            <div class="table-wrapper">
                <table style="font-size:0.85rem;">
                    <thead>
                        <tr>
                            <th>Nama Siswa</th>
                            <th style="text-align:center; width:120px;">Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $st)
                        <tr>
                            <td class="font-bold">{{ $st['name'] }}</td>
                            <td style="text-align:center; font-weight:800; color:#dc2626;">{{ number_format($st['score'], 1) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endforeach
    </div>
@empty
<div class="modern-card" style="padding:3rem;text-align:center;">
    <p class="text-slate-500 font-bold">Tidak ada topik dengan nilai di bawah KKM.</p>
</div>
@endforelse

<div style="margin-top:2rem;">
    <a href="/principal/dashboard" class="text-indigo-600 font-bold text-sm" style="text-decoration:none;">&larr; Kembali ke Dashboard</a>
</div>
@endif
@endsection