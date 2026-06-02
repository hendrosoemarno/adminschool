@extends('layouts.app')
@section('title', 'Siswa Excellent SMA - Demo')
@section('page_header', 'Siswa dengan Capaian Excellent SMA')
@section('page_subtitle', 'Daftar 55 siswa yang mencapai target sekolah (≥ 70).')
@section('content')
@php
$kkm = 70;
$maleNames = ['Aydin Zafir','Azam Firdaus','Baharuddin Athar','Barakah Syahid','Baraq Asyraf','Basyir Alim','Basyirul Ummah','Beryl Afkar','Bilal Raziq','Cahya Wafi','Eshan Muzaffar','Ezar Fayyadh','Fadhlan Khair','Fahmi Qawi','Faris Adnan','Faris Nuruddin','Fathan Mubarak','Fatih Alfarizqi','Fattan Akhdan','Fikri Syahputra','Ghaits Arkan','Ghani Rafif','Ghassan Jabir','Ghazali Ahmad','Ghufran Athallah','Hadiansyah Putra','Hafizuddin Nuur','Haidar Abbas','Haifa Muttaqin','Hamdan Syakiri','Hamzah Zaidan','Haziq Muazzam','Ihsan Kamil','Ilham Alfarezi','Imran Zaky','Irfan Jauhari','Irsyad Falah','Izzan Fauzan','Izzat Rabbani','Izzuddin Rahmat','Jalaluddin Bahri','Qadir Rabbani','Qaid Ammar','Rafasya Shadiq','Raka Fadhil','Rayyan Ghazi','Raziq Hafizh','Saifuddin Badar','Sultan Hanif','Taqiuddin Bassam'];
$femaleNames = ['Azkadina Kanza','Balqis Faiza','Banafsha Aulia','Batrisyia Amira','Belva Azkadina','Callysta Rifda','Calya Zunaira','Carissa Fathia','Dania Rahma','Eshal Zhalila','Faiza Syafira','Farida Hanum','Farzana Aulia','Fathiya Aliza','Fatimah Azzahra','Ghaida Zhafira','Ghania Khalisa','Hilya Nafisa','Inaya Rahman','Irbah Khalisa','Izzah Salsabila','Izzaty Azzahra','Jameela Nadira','Jannati Fadhila','Jauza Nafisa','Khalisa Zian','Kirana Zunaira','Larasati Fadhila','Lathifa Anindya','Lathifa Aulia','Layla Faiha','Mahira Khalila','Maryam Aqila','Qilla Azzahra','Rabiatul Adawiyah','Raisa Farzana','Rania Syafira','Raudhah Athira','Safa Marwah','Ulfa Zukhruf','Ulfiana Khairunnisa','Umniya Hanifa','Vania Athira','Vira Zukhruf','Virda Azkayra','Wafa Nazhifa','Wafa Zakia','Wardah Kamilia','Xabira Zayna','Xavia Zayna'];
$classes = ['12A','12B','12C','12D','12E','12F'];
$allNames = array_merge($maleNames, $femaleNames);
$students = [];
foreach ($allNames as $i => $name) {
    $level = 50 + (($i * 17 + 5) % 41);
    $students[] = ['name' => $name, 'class' => $classes[$i % 6], 'level' => $level];
}
$subjects = [
    'Matematika (Wajib)' => ['adj' => -2],
    'Bahasa Indonesia (Wajib)' => ['adj' => 0],
    'Bahasa Inggris (Wajib)' => ['adj' => 1],
    'Matematika Tingkat Lanjut' => ['adj' => -5],
    'Bahasa Indonesia Tingkat Lanjut' => ['adj' => -1],
    'Bahasa Inggris Tingkat Lanjut' => ['adj' => -2],
    'Fisika' => ['adj' => -3],
    'Kimia' => ['adj' => -2],
    'Biologi' => ['adj' => 2],
    'Ekonomi' => ['adj' => 3],
    'Geografi' => ['adj' => 1],
    'Sosiologi' => ['adj' => 2],
    'Sejarah' => ['adj' => 1],
];
$excellentStudents = array_filter($students, function($st) use ($subjects) {
    $total = 0;
    $si = 0;
    foreach ($subjects as $s) {
        $total += $st['level'] + $s['adj'];
        $si++;
    }
    return ($total / $si) >= 70;
});
$excellentStudents = array_values($excellentStudents);
$subjKeys = array_keys($subjects);
$subjIdx = 0;
@endphp
<div class="modern-card" style="margin-bottom:2rem;"><p style="color:var(--text-sub);">Sekolah: <strong>SMA NEGERI 1 HARAPAN BANGSA</strong> — Target: ≥ {{ $kkm }} — {{ count($excellentStudents) }} siswa excellent</p></div>
<div class="modern-card">
    <h3 style="color:var(--text-main);font-weight:700;margin-bottom:1rem;">Daftar Siswa Excellent</h3>
    <div class="table-wrapper"><table>
        <thead><tr><th>Nama Siswa</th><th>Kelas</th>
            @foreach($subjKeys as $sk)<th style="text-align:center;font-size:11px;">{{ $sk }}</th>@endforeach
        </tr></thead>
        <tbody>
            @foreach($excellentStudents as $i => $st)
            @php
                $total = 0; $cnt = 0;
                $scores = [];
                foreach ($subjects as $subj) {
                    $s = $st['level'] + $subj['adj'];
                    $scores[] = $s;
                    $total += $s; $cnt++;
                }
                $avg = $total / $cnt;
            @endphp
            <tr>
                <td style="font-weight:700;">{{ $st['name'] }}</td>
                <td>{{ $st['class'] }}</td>
                @foreach($scores as $s)
                    <td style="text-align:center;font-weight:800;{{ $s < $kkm ? 'color:#d97706;' : 'color:#059669;' }}">{{ number_format($s,1) }}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table></div>
</div>
<div style="margin-top:2rem;"><a href="{{ url('/demo/sma/principal') }}" style="color:#4f46e5;font-weight:700;font-size:0.875rem;text-decoration:none;">&larr; Kembali ke Dashboard</a></div>
@endsection
