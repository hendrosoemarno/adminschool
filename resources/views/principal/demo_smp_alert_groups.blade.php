@extends('layouts.app')
@section('title', 'Kelompok Alert SMP - Demo')
@section('page_header', 'Kelompok Topik Alert SMP')
@section('page_subtitle', 'Topik dengan siswa di bawah KKM (Demo SMP).')
@section('content')
<style>
    .dark .topic-card { background:rgba(220,38,38,0.1) !important; }
    .dark .topic-card h4 { color:#fca5a5 !important; }
    .dark .topic-card .student-count { color:var(--text-sub) !important; }
</style>
@php
$kkm = 70;
$groups = [
    'Matematika' => [
        'Bilangan Real' => 70,
        'Persamaan dan Pertidaksamaan Linier' => 68,
        'Bentuk Aljabar' => 65,
        'Fungsi' => 55,
        'Barisan dan Deret' => 58,
        'Pengukuran' => 62,
        'Peluang' => 65,
        'Geometri' => 58,
        'Transformasi Geometri' => 62,
    ],
    'Bahasa Indonesia' => [
        'Istilah' => 65,
        'Objek & Latar' => 62,
        'Info Tersurat' => 68,
        'Kerangka Teks' => 60,
        'Ide Pokok' => 58,
        'Logika Hub.' => 65,
        'Bahasa Kias' => 62,
        'Relevansi' => 68,
        'Kesesuaian Unsur' => 60,
        'Respons Emosi' => 64,
    ],
];
@endphp
<div class="modern-card" style="margin-bottom:2rem;"><p style="color:var(--text-sub);">Sekolah: <strong>SMP NEGERI 1 HARAPAN BANGSA</strong> — KKM: {{ $kkm }}</p></div>
@foreach($groups as $subject => $topics)
<div class="modern-card" style="margin-bottom:2rem;border-left:4px solid #dc2626;">
    <h3 style="color:var(--text-main);font-weight:700;margin-bottom:1rem;">{{ $subject }}</h3>
    @foreach($topics as $topic => $maxScore)
    @php
        if ($subject === 'Matematika') {
            $students = [];
            if ($topic === 'Bilangan Real') { $students = [['name'=>'Muhammad Fayyadh','score'=>68],['name'=>'Kayla Nadhira','score'=>65]]; }
            elseif ($topic === 'Persamaan dan Pertidaksamaan Linier') { $students = [['name'=>'Kayla Nadhira','score'=>58],['name'=>'Hafsa Arumi','score'=>68]]; }
            elseif ($topic === 'Bentuk Aljabar') { $students = [['name'=>'Muhammad Fayyadh','score'=>65],['name'=>'Kayla Nadhira','score'=>62]]; }
            elseif ($topic === 'Fungsi') { $students = [['name'=>'Kayla Nadhira','score'=>55]]; }
            elseif ($topic === 'Barisan dan Deret') { $students = [['name'=>'Muhammad Fayyadh','score'=>58],['name'=>'Kayla Nadhira','score'=>60],['name'=>'Hafsa Arumi','score'=>62]]; }
            elseif ($topic === 'Pengukuran') { $students = [['name'=>'Muhammad Fayyadh','score'=>62],['name'=>'Kayla Nadhira','score'=>68],['name'=>'Hafsa Arumi','score'=>65]]; }
            elseif ($topic === 'Peluang') { $students = [['name'=>'Kayla Nadhira','score'=>65]]; }
            elseif ($topic === 'Geometri') { $students = [['name'=>'Kayla Nadhira','score'=>58]]; }
            elseif ($topic === 'Transformasi Geometri') { $students = [['name'=>'Muhammad Fayyadh','score'=>68],['name'=>'Kayla Nadhira','score'=>62],['name'=>'Hafsa Arumi','score'=>66]]; }
        }
        if ($subject === 'Bahasa Indonesia') {
            $students = [];
            if ($topic === 'Istilah') { $students = [['name'=>'Kayla Nadhira','score'=>65]]; }
            elseif ($topic === 'Objek & Latar') { $students = [['name'=>'Muhammad Fayyadh','score'=>68],['name'=>'Kayla Nadhira','score'=>62]]; }
            elseif ($topic === 'Info Tersurat') { $students = [['name'=>'Kayla Nadhira','score'=>68]]; }
            elseif ($topic === 'Kerangka Teks') { $students = [['name'=>'Kayla Nadhira','score'=>60],['name'=>'Hafsa Arumi','score'=>68]]; }
            elseif ($topic === 'Ide Pokok') { $students = [['name'=>'Muhammad Fayyadh','score'=>65],['name'=>'Kayla Nadhira','score'=>58]]; }
            elseif ($topic === 'Logika Hub.') { $students = [['name'=>'Kayla Nadhira','score'=>65],['name'=>'Hafsa Arumi','score'=>66]]; }
            elseif ($topic === 'Bahasa Kias') { $students = [['name'=>'Muhammad Fayyadh','score'=>68],['name'=>'Kayla Nadhira','score'=>62],['name'=>'Hafsa Arumi','score'=>68]]; }
            elseif ($topic === 'Relevansi') { $students = [['name'=>'Kayla Nadhira','score'=>68]]; }
            elseif ($topic === 'Kesesuaian Unsur') { $students = [['name'=>'Kayla Nadhira','score'=>60]]; }
            elseif ($topic === 'Respons Emosi') { $students = [['name'=>'Muhammad Fayyadh','score'=>66],['name'=>'Kayla Nadhira','score'=>64]]; }
        }
    @endphp
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
<div style="margin-top:2rem;"><a href="{{ url('/demo/smp/principal') }}" style="color:#4f46e5;font-weight:700;font-size:0.875rem;text-decoration:none;">&larr; Kembali ke Dashboard</a></div>
@endsection
