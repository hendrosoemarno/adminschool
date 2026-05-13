@extends('layouts.app')
@section('title', 'Siswa Alert - Demo')
@section('page_header', 'Siswa Butuh Perhatian (Alert)')
@section('page_subtitle', 'Siswa dengan topik di bawah KKM per mata pelajaran (Demo).')
@section('content')
@php
$kkm = 70;
$subjectSections = [
    'Matematika' => ['kkm'=>70,'topics'=>['KPK DAN FPB','Bangun Datar','Bangun Ruang','Pengukuran','Aljabar'],'students'=>[
        ['name'=>'Muhammad Fayyadh','topics'=>['KPK DAN FPB'=>88,'Bangun Datar'=>65,'Bangun Ruang'=>72,'Pengukuran'=>58,'Aljabar'=>70]],
        ['name'=>'Kayla Nadhira','topics'=>['KPK DAN FPB'=>55,'Bangun Datar'=>71,'Bangun Ruang'=>68,'Pengukuran'=>62,'Aljabar'=>75]],
    ]],
    'Bahasa Indonesia' => ['kkm'=>70,'topics'=>['Identifikasi objek','Kosakata','Ide pokok','Informasi tersurat','Makna ungkapan'],'students'=>[
        ['name'=>'Hafsa Arumi','topics'=>['Identifikasi objek'=>62,'Kosakata'=>75,'Ide pokok'=>58,'Informasi tersurat'=>70,'Makna ungkapan'=>65]],
        ['name'=>'Muhammad Fayyadh','topics'=>['Identifikasi objek'=>55,'Kosakata'=>68,'Ide pokok'=>72,'Informasi tersurat'=>60,'Makna ungkapan'=>58]],
    ]],
    'IPA' => ['kkm'=>70,'topics'=>['Sistem gerak','Peredaran darah','Pencernaan','Ekosistem'],'students'=>[
        ['name'=>'Aisyah Humaira','topics'=>['Sistem gerak'=>68,'Peredaran darah'=>72,'Pencernaan'=>65,'Ekosistem'=>75]],
        ['name'=>'Hafsa Arumi','topics'=>['Sistem gerak'=>55,'Peredaran darah'=>62,'Pencernaan'=>58,'Ekosistem'=>70]],
        ['name'=>'Muhammad Fayyadh','topics'=>['Sistem gerak'=>60,'Peredaran darah'=>65,'Pencernaan'=>55,'Ekosistem'=>68]],
    ]],
];
@endphp
<div class="modern-card" style="margin-bottom:2rem;"><p class="text-slate-500">Sekolah: <strong>SD NEGERI 1 HARAPAN BANGSA</strong> — KKM: {{ $kkm }}</p></div>
@foreach($subjectSections as $name => $sec)
<div class="modern-card" style="margin-bottom:2rem;border-left:4px solid var(--danger);">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem;">
        <div><h3 class="text-slate-800 font-bold">{{ $name }}</h3><p class="text-xs text-slate-500 mt-1">{{ count($sec['students']) }} siswa alert</p></div>
    </div>
    <div class="table-wrapper"><table>
        <thead><tr><th>Nama Siswa</th>@foreach($sec['topics'] as $t)<th style="text-align:center;font-size:11px;">{{ $t }}</th>@endforeach</tr></thead>
        <tbody>
            @foreach($sec['students'] as $st)
            <tr>
                <td class="font-bold">{{ $st['name'] }}</td>
                @foreach($sec['topics'] as $t)
                    @php $s = $st['topics'][$t] ?? '-'; $red = is_numeric($s) && $s < $sec['kkm']; @endphp
                    <td style="text-align:center;font-weight:800;{{ $red ? 'color:#dc2626;' : 'color:#059669;' }}">{{ is_numeric($s) ? number_format($s,1) : '-' }}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table></div>
</div>
@endforeach
<div style="margin-top:2rem;"><a href="/demo/principal" class="text-indigo-600 font-bold text-sm" style="text-decoration:none;">&larr; Kembali ke Dashboard</a></div>
@endsection
