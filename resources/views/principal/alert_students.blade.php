@extends('layouts.app')

@section('title', 'Siswa Alert - AI Learning')
@section('page_header', 'Siswa Butuh Perhatian (Alert)')
@section('page_subtitle', 'Daftar siswa dengan nilai di bawah KKM yang membutuhkan intervensi.')

@section('content')
@if(isset($error))
<div class="modern-card" style="border-left:4px solid var(--danger);padding:2rem;text-align:center;">
    <p class="text-rose-600 font-bold">{{ $error }}</p>
</div>
@else

<div class="modern-card" style="margin-bottom:2rem;">
    <div style="display:flex;justify-content:space-between;align-items:center;">
        <p class="text-slate-500">Sekolah: <strong>{{ $school->school_name }}</strong> — KKM: 70</p>
        <span class="text-xs text-slate-400">{{ count($students) }} Siswa</span>
    </div>
</div>

<div class="modern-card">
    <h3 class="text-slate-800 font-bold mb-4">Daftar Siswa Alert</h3>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    @foreach($subjects as $sub)
                        <th style="text-align:center;">{{ $sub->topic_name }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @forelse($students as $st)
                <tr>
                    <td class="font-bold">{{ $st['name'] }}</td>
                    <td>{{ $st['class'] }}</td>
                    @foreach($subjects as $sub)
                        @php $sc = $st['subjectScores'][$sub->topic_name] ?? '-'; @endphp
                        <td style="text-align:center;font-weight:800;color:{{ $sc !== '-' ? ($sc >= 75 ? '#059669' : ($sc >= 70 ? '#d97706' : '#dc2626')) : '#94a3b8' }};">
                            {{ $sc }}
                        </td>
                    @endforeach
                </tr>
                @empty
                <tr><td colspan="{{ 2 + $subjects->count() }}" style="text-align:center;padding:2rem;">Semua siswa berada di atas KKM.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div style="margin-top:2rem;">
    <a href="/principal/dashboard" class="text-indigo-600 font-bold text-sm" style="text-decoration:none;">&larr; Kembali ke Dashboard</a>
</div>
@endif
@endsection