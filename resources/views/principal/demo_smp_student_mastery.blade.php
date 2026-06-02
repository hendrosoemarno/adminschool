@extends('layouts.app')
@section('title', 'Detail Mastery SMP - Demo')
@section('page_header', 'Detail Rata-rata Mastery Siswa SMP')
@section('page_subtitle', 'Daftar siswa beserta nilai per topik (Demo SMP).')
@section('content')
<div class="modern-card" style="margin-bottom:2rem;"><p style="color:var(--text-sub);">Sekolah: <strong>SMP NEGERI 1 HARAPAN BANGSA</strong> — KKM: 70</p></div>
@php
$kkm = 70;
$mtkTopics = [
    'Bil. Real' => 'Bilangan Real',
    'Pers. & Pt. Linier' => 'Persamaan dan Pertidaksamaan Linier',
    'Btk. Aljabar' => 'Bentuk Aljabar',
    'Fungsi' => 'Fungsi',
    'Bar. & Deret' => 'Barisan dan Deret',
    'Pengukuran' => 'Pengukuran',
    'Data' => 'Data',
    'Peluang' => 'Peluang',
    'Geometri' => 'Geometri',
    'Trans. Geo.' => 'Transformasi Geometri',
];
$biTopics = [
    'Istilah' => 'Mengidentifikasi penggunaan istilah dalam berbagai bidang.',
    'Objek & Latar' => 'Mengidentifikasi objek dan/atau latar berdasarkan kosakata yang digunakan dalam teks fiksi atau nonfiksi.',
    'Info Tersurat' => 'Mengidentifikasi informasi penting yang tersurat dalam teks.',
    'Kerangka Teks' => 'Menyusun kerangka atau bagan berdasarkan bagian-bagian penting dalam teks.',
    'Ide Pokok' => 'Menyimpulkan ide pokok, gagasan pendukung, tokoh, peristiwa, latar, dan/atau nilai-nilai dalam dan/atau antarteks.',
    'Logika Hub.' => 'Menjelaskan kelogisan hubungan antarperistiwa, antargagasan, dan/atau antarinformasi dalam dan/atau antarteks.',
    'Prediksi' => 'Memprediksi peristiwa dalam teks.',
    'Bahasa Kias' => 'Menjelaskan bahasa kias dan citraan yang digunakan dalam teks fiksi.',
    'Relevansi' => 'Menilai relevansi peristiwa dalam teks dengan kehidupan sehari-hari.',
    'Kesesuaian Unsur' => 'Menilai kesesuaian dan/atau keakuratan unsur, kebahasaan, atau isi berdasarkan perbandingan informasi dalam dan/atau antarteks.',
    'Respons Emosi' => 'Menyimpulkan respons emosional terhadap unsur teks fiksi.',
];
$students = [
    ['name'=>'Aisyah Humaira','class'=>'7A','mtk'=>[88,85,82,90,86,78,92,88,84,80],'bi'=>[90,88,92,85,88,86,90,84,88,82,86]],
    ['name'=>'Zahra Safiya','class'=>'7A','mtk'=>[82,79,76,84,80,75,86,82,78,76],'bi'=>[84,82,86,80,82,78,84,80,82,78,80]],
    ['name'=>'Layla Najwa','class'=>'7A','mtk'=>[84,80,78,86,82,76,88,84,80,78],'bi'=>[86,84,88,82,84,80,86,82,84,80,82]],
    ['name'=>'Muhammad Fayyadh','class'=>'7B','mtk'=>[68,72,65,70,58,62,75,70,72,68],'bi'=>[72,68,75,70,65,70,72,68,75,70,66]],
    ['name'=>'Kayla Nadhira','class'=>'7B','mtk'=>[65,58,62,55,60,68,72,65,58,62],'bi'=>[65,62,68,60,58,65,70,62,68,60,64]],
    ['name'=>'Hafsa Arumi','class'=>'7C','mtk'=>[72,68,70,75,62,65,78,72,70,66],'bi'=>[72,70,74,68,72,66,70,68,74,72,70]],
];
@endphp
<div class="modern-card" style="margin-bottom:2rem;">
    <h3 style="color:var(--text-main);font-weight:700;margin-bottom:1rem;">Matematika</h3>
    <div class="table-wrapper"><table>
        <thead><tr><th>Nama Siswa</th><th>Kelas</th>
            @foreach($mtkTopics as $short => $full)<th style="text-align:center;font-size:11px;" title="{{ $full }}">{{ $short }}</th>@endforeach
        </tr></thead>
        <tbody>
            @foreach($students as $i => $st)
            <tr>
                <td style="font-weight:700;">{{ $st['name'] }}</td>
                <td>{{ $st['class'] }}</td>
                @foreach($st['mtk'] as $score)
                    @php $red = $score < $kkm; @endphp
                    <td style="text-align:center;font-weight:800;{{ $red ? 'color:#dc2626;' : 'color:#059669;' }}">{{ number_format($score,1) }}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table></div>
</div>
<div class="modern-card">
    <h3 style="color:var(--text-main);font-weight:700;margin-bottom:1rem;">Bahasa Indonesia</h3>
    <div class="table-wrapper"><table>
        <thead><tr><th>Nama Siswa</th><th>Kelas</th>
            @foreach($biTopics as $short => $full)<th style="text-align:center;font-size:11px;" title="{{ $full }}">{{ $short }}</th>@endforeach
        </tr></thead>
        <tbody>
            @foreach($students as $i => $st)
            <tr>
                <td style="font-weight:700;">{{ $st['name'] }}</td>
                <td>{{ $st['class'] }}</td>
                @foreach($st['bi'] as $score)
                    @php $red = $score < $kkm; @endphp
                    <td style="text-align:center;font-weight:800;{{ $red ? 'color:#dc2626;' : 'color:#059669;' }}">{{ number_format($score,1) }}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table></div>
</div>
<div style="margin-top:2rem;"><a href="{{ url('/demo/smp/principal') }}" style="color:#4f46e5;font-weight:700;font-size:0.875rem;text-decoration:none;">&larr; Kembali ke Dashboard</a></div>
@endsection
