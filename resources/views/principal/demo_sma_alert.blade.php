@extends('layouts.app')
@section('title', 'Siswa Alert SMA - Demo')
@section('page_header', 'Siswa Butuh Perhatian (Alert) SMA')
@section('page_subtitle', 'Siswa dengan topik di bawah KKM per mata pelajaran (Demo SMA).')
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
    'Matematika (Wajib)' => ['adj'=>-2, 'topics'=>['Bilangan','Aljabar','Geometri','Trigonometri','Data & Peluang']],
    'Bahasa Indonesia (Wajib)' => ['adj'=>0, 'topics'=>['Info Tersurat','Mengelompokkan','Menyimpulkan','Menilai Gagasan','Menanggapi']],
    'Bahasa Inggris (Wajib)' => ['adj'=>1, 'topics'=>['Info Eksplisit','Info Implisit','Menafsirkan','Menilai Makna']],
    'Matematika Tingkat Lanjut' => ['adj'=>-5, 'topics'=>['Fungsi Kompleks','Program Linear','Matriks','Transformasi','Stat. Lanjutan']],
    'Bahasa Indonesia Tingkat Lanjut' => ['adj'=>-1, 'topics'=>['Gagasan & Argumen','Koherensi & Kohesi','Makna Simbolik','Kualitas Penalaran']],
    'Bahasa Inggris Tingkat Lanjut' => ['adj'=>-2, 'topics'=>['Membaca Kritis','Ide Abstrak','Validitas Argumen']],
    'Fisika' => ['adj'=>-3, 'topics'=>['Pengukuran','Gerak','Dinamika','Usaha & Energi','Gelombang','Listrik','Magnet','Termodinamika']],
    'Kimia' => ['adj'=>-2, 'topics'=>['Struktur Atom','Sistem Periodik','Ikatan Kimia','Reaksi Kimia','Stoikiometri','Larutan','Asam-Basa','Termokimia']],
    'Biologi' => ['adj'=>2, 'topics'=>['Sel & Jaringan','Genetika','Ekologi','Sistem Organ','Evolusi','Bioteknologi']],
    'Ekonomi' => ['adj'=>3, 'topics'=>['Prinsip Ekonomi','Ekonomi Mikro','Ekonomi Makro','Ekonomi Internasional','Akuntansi Dasar']],
    'Geografi' => ['adj'=>1, 'topics'=>['Litosfer','Kependudukan','SIG','Mitigasi Bencana']],
    'Sosiologi' => ['adj'=>2, 'topics'=>['Interaksi Sosial','Struktur Sosial','Perubahan Sosial','Lembaga Sosial','Penyimpangan Sosial']],
    'Sejarah' => ['adj'=>1, 'topics'=>['Periodisasi','Nasional & Dunia','Peradaban','Pergerakan Nasional']],
];

function getTS($studentIdx, $subjectIdx, $topicIdx, $level, $adj) {
    return max(0, min(100, $level + $adj + ((($studentIdx * 7 + $subjectIdx * 13 + $topicIdx * 5) % 15) - 7)));
}

$subjKeys = array_keys($subjects);
@endphp
<div class="modern-card" style="margin-bottom:2rem;"><p style="color:var(--text-sub);">Sekolah: <strong>SMA NEGERI 1 HARAPAN BANGSA</strong> — KKM: {{ $kkm }}</p></div>
@foreach($subjects as $subjName => $subj)
@php
    $si = array_search($subjName, $subjKeys) + 1;
    $alertStudents = [];
    foreach ($students as $sti => $st) {
        $hasAlert = false;
        foreach ($subj['topics'] as $ti => $t) {
            $s = getTS($sti, $si, $ti, $st['level'], $subj['adj']);
            if ($s < $kkm) { $hasAlert = true; break; }
        }
        if ($hasAlert) {
            $scores = [];
            foreach ($subj['topics'] as $ti => $t) {
                $scores[] = getTS($sti, $si, $ti, $st['level'], $subj['adj']);
            }
            $alertStudents[] = ['name' => $st['name'], 'class' => $st['class'], 'scores' => $scores];
        }
    }
@endphp
@if(count($alertStudents) > 0)
<div class="modern-card" style="margin-bottom:2rem;border-left:4px solid #dc2626;">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem;">
        <div><h3 style="color:var(--text-main);font-weight:700;">{{ $subjName }}</h3><p style="font-size:0.75rem;color:var(--text-sub);">{{ count($alertStudents) }} siswa alert</p></div>
    </div>
    <div class="table-wrapper"><table>
        <thead><tr><th>Nama Siswa</th>
            @foreach($subj['topics'] as $t)<th style="text-align:center;font-size:11px;">{{ $t }}</th>@endforeach
        </tr></thead>
        <tbody>
            @foreach($alertStudents as $st)
            <tr>
                <td style="font-weight:700;">{{ $st['name'] }} <span style="color:var(--text-sub);font-weight:400;">({{ $st['class'] }})</span></td>
                @foreach($st['scores'] as $s)
                    @php $red = $s < $kkm; @endphp
                    <td style="text-align:center;font-weight:800;{{ $red ? 'color:#dc2626;' : 'color:#059669;' }}">{{ number_format($s,1) }}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table></div>
</div>
@endif
@endforeach
<div style="margin-top:2rem;"><a href="/demo/sma/principal" style="color:#4f46e5;font-weight:700;font-size:0.875rem;text-decoration:none;">&larr; Kembali ke Dashboard</a></div>
@endsection
