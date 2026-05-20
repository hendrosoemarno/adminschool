@extends('layouts.app')
@section('title', 'Kelompok Alert - Demo')
@section('page_header', 'Kelompok Topik Alert')
@section('page_subtitle', 'Topik dengan siswa di bawah KKM (Demo).')
@section('content')
<style>
    .dark .topic-card { background:rgba(220,38,38,0.1) !important; }
    .dark .topic-card h4 { color:#fca5a5 !important; }
    .dark .topic-card .student-count { color:var(--text-sub) !important; }
</style>
@php
$groups = [
    'Matematika' => [
        'Bangun Datar' => [['name'=>'Muhammad Fayyadh','score'=>65],['name'=>'Kayla Nadhira','score'=>58]],
        'Pengukuran' => [['name'=>'Muhammad Fayyadh','score'=>58],['name'=>'Hafsa Arumi','score'=>62]],
        'KPK DAN FPB' => [['name'=>'Kayla Nadhira','score'=>55]],
    ],
    'Bahasa Indonesia' => [
        'Identifikasi objek' => [['name'=>'Hafsa Arumi','score'=>62],['name'=>'Muhammad Fayyadh','score'=>55]],
        'Ide pokok' => [['name'=>'Hafsa Arumi','score'=>58]],
        'Makna ungkapan' => [['name'=>'Hafsa Arumi','score'=>65],['name'=>'Muhammad Fayyadh','score'=>58]],
    ],
];
@endphp
<div class="modern-card" style="margin-bottom:2rem;"><p style="color:var(--text-sub);">Sekolah: <strong>SD NEGERI 1 HARAPAN BANGSA</strong> — KKM: 70</p></div>
@foreach($groups as $subject => $topics)
<div class="modern-card" style="margin-bottom:2rem;border-left:4px solid #dc2626;">
    <h3 style="color:var(--text-main);font-weight:700;margin-bottom:1rem;">{{ $subject }}</h3>
    @foreach($topics as $topic => $students)
    <div class="topic-card" style="margin-bottom:1.5rem;padding:1rem;background:#fef2f2;border-radius:12px;">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:0.75rem;">
            <h4 class="font-bold" style="color:#be123c;">{{ $topic }}</h4>
            <span class="student-count text-xs" style="color:#64748b;">{{ count($students) }} siswa</span>
        </div>
        <div class="table-wrapper"><table style="font-size:0.85rem;">
            <thead><tr><th>Nama Siswa</th><th style="text-align:center;width:120px;">Nilai</th></tr></thead>
            <tbody>
            @foreach($students as $st)
            <tr><td style="font-weight:700;">{{ $st['name'] }}</td><td style="text-align:center;font-weight:800;color:#dc2626;">{{ number_format($st['score'],1) }}</td></tr>
            @endforeach
            </tbody>
        </table></div>
    </div>
    @endforeach
</div>
@endforeach
<div style="margin-top:2rem;"><a href="/demo/principal" style="color:#4f46e5;font-weight:700;font-size:0.875rem;text-decoration:none;">&larr; Kembali ke Dashboard</a></div>
@endsection
