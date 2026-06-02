@extends('layouts.app')
@section('title', 'Siswa Alert SMP - Demo')
@section('page_header', 'Siswa Butuh Perhatian (Alert) SMP')
@section('page_subtitle', 'Siswa dengan topik di bawah KKM per mata pelajaran (Demo SMP).')
@section('content')
@php
$kkm = 70;
$mtkTopics = ['Bilangan Real','Persamaan dan Pertidaksamaan Linier','Bentuk Aljabar','Fungsi','Barisan dan Deret','Pengukuran','Data','Peluang','Geometri','Transformasi Geometri'];
$biTopics = ['Istilah','Objek & Latar','Info Tersurat','Kerangka Teks','Ide Pokok','Logika Hub.','Prediksi','Bahasa Kias','Relevansi','Kesesuaian Unsur','Respons Emosi'];
$biFull = [
    'Mengidentifikasi penggunaan istilah dalam berbagai bidang.',
    'Mengidentifikasi objek dan/atau latar berdasarkan kosakata yang digunakan dalam teks fiksi atau nonfiksi.',
    'Mengidentifikasi informasi penting yang tersurat dalam teks.',
    'Menyusun kerangka atau bagan berdasarkan bagian-bagian penting dalam teks.',
    'Menyimpulkan ide pokok, gagasan pendukung, tokoh, peristiwa, latar, dan/atau nilai-nilai dalam dan/atau antarteks.',
    'Menjelaskan kelogisan hubungan antarperistiwa, antargagasan, dan/atau antarinformasi dalam dan/atau antarteks.',
    'Memprediksi peristiwa dalam teks.',
    'Menjelaskan bahasa kias dan citraan yang digunakan dalam teks fiksi.',
    'Menilai relevansi peristiwa dalam teks dengan kehidupan sehari-hari.',
    'Menilai kesesuaian dan/atau keakuratan unsur, kebahasaan, atau isi berdasarkan perbandingan informasi dalam dan/atau antarteks.',
    'Menyimpulkan respons emosional terhadap unsur teks fiksi.',
];
$subjectSections = [
    'Matematika' => [
        'topics' => $mtkTopics,
        'students' => [
            ['name' => 'Muhammad Fayyadh', 'scores' => [68,72,65,70,58,62,75,70,72,68]],
            ['name' => 'Kayla Nadhira',   'scores' => [65,58,62,55,60,68,72,65,58,62]],
            ['name' => 'Hafsa Arumi',     'scores' => [72,68,70,75,62,65,78,72,70,66]],
        ],
    ],
    'Bahasa Indonesia' => [
        'topics' => $biTopics,
        'full'   => $biFull,
        'students' => [
            ['name' => 'Muhammad Fayyadh', 'scores' => [72,68,75,70,65,70,72,68,75,70,66]],
            ['name' => 'Kayla Nadhira',   'scores' => [65,62,68,60,58,65,70,62,68,60,64]],
            ['name' => 'Hafsa Arumi',     'scores' => [72,70,74,68,72,66,70,68,74,72,70]],
        ],
    ],
];
@endphp
<div class="modern-card" style="margin-bottom:2rem;"><p style="color:var(--text-sub);">Sekolah: <strong>SMP NEGERI 1 HARAPAN BANGSA</strong> — KKM: {{ $kkm }}</p></div>
@foreach($subjectSections as $name => $sec)
<div class="modern-card" style="margin-bottom:2rem;border-left:4px solid #dc2626;">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem;">
        <div><h3 style="color:var(--text-main);font-weight:700;">{{ $name }}</h3><p style="font-size:0.75rem;color:var(--text-sub);">{{ count($sec['students']) }} siswa alert</p></div>
    </div>
    <div class="table-wrapper"><table>
        <thead><tr><th>Nama Siswa</th>
            @foreach($sec['topics'] as $ti => $t)
                <th style="text-align:center;font-size:11px;" title="{{ isset($sec['full']) ? $sec['full'][$ti] : $t }}">{{ $t }}</th>
            @endforeach
        </tr></thead>
        <tbody>
            @foreach($sec['students'] as $st)
            <tr>
                <td style="font-weight:700;">{{ $st['name'] }}</td>
                @foreach($st['scores'] as $s)
                    @php $red = $s < $kkm; @endphp
                    <td style="text-align:center;font-weight:800;{{ $red ? 'color:#dc2626;' : 'color:#059669;' }}">{{ number_format($s,1) }}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table></div>
</div>
@endforeach
<div style="margin-top:2rem;"><a href="{{ url('/demo/smp/principal') }}" style="color:#4f46e5;font-weight:700;font-size:0.875rem;text-decoration:none;">&larr; Kembali ke Dashboard</a></div>
@endsection
