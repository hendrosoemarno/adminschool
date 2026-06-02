@extends('layouts.app')
@section('title', 'Detail Mastery SMA - Demo')
@section('page_header', 'Detail Rata-rata Mastery Siswa SMA')
@section('page_subtitle', 'Daftar 100 siswa beserta nilai per topik (Demo SMA).')
@section('content')
@php
$kkm = 70;

$students = [];
$maleNames = ['Aydin Zafir','Azam Firdaus','Baharuddin Athar','Barakah Syahid','Baraq Asyraf','Basyir Alim','Basyirul Ummah','Beryl Afkar','Bilal Raziq','Cahya Wafi','Eshan Muzaffar','Ezar Fayyadh','Fadhlan Khair','Fahmi Qawi','Faris Adnan','Faris Nuruddin','Fathan Mubarak','Fatih Alfarizqi','Fattan Akhdan','Fikri Syahputra','Ghaits Arkan','Ghani Rafif','Ghassan Jabir','Ghazali Ahmad','Ghufran Athallah','Hadiansyah Putra','Hafizuddin Nuur','Haidar Abbas','Haifa Muttaqin','Hamdan Syakiri','Hamzah Zaidan','Haziq Muazzam','Ihsan Kamil','Ilham Alfarezi','Imran Zaky','Irfan Jauhari','Irsyad Falah','Izzan Fauzan','Izzat Rabbani','Izzuddin Rahmat','Jalaluddin Bahri','Qadir Rabbani','Qaid Ammar','Rafasya Shadiq','Raka Fadhil','Rayyan Ghazi','Raziq Hafizh','Saifuddin Badar','Sultan Hanif','Taqiuddin Bassam'];
$femaleNames = ['Azkadina Kanza','Balqis Faiza','Banafsha Aulia','Batrisyia Amira','Belva Azkadina','Callysta Rifda','Calya Zunaira','Carissa Fathia','Dania Rahma','Eshal Zhalila','Faiza Syafira','Farida Hanum','Farzana Aulia','Fathiya Aliza','Fatimah Azzahra','Ghaida Zhafira','Ghania Khalisa','Hilya Nafisa','Inaya Rahman','Irbah Khalisa','Izzah Salsabila','Izzaty Azzahra','Jameela Nadira','Jannati Fadhila','Jauza Nafisa','Khalisa Zian','Kirana Zunaira','Larasati Fadhila','Lathifa Anindya','Lathifa Aulia','Layla Faiha','Mahira Khalila','Maryam Aqila','Qilla Azzahra','Rabiatul Adawiyah','Raisa Farzana','Rania Syafira','Raudhah Athira','Safa Marwah','Ulfa Zukhruf','Ulfiana Khairunnisa','Umniya Hanifa','Vania Athira','Vira Zukhruf','Virda Azkayra','Wafa Nazhifa','Wafa Zakia','Wardah Kamilia','Xabira Zayna','Xavia Zayna'];
$classes = ['12A','12B','12C','12D','12E','12F'];
$allNames = array_merge($maleNames, $femaleNames);

foreach ($allNames as $i => $name) {
    $level = 50 + (($i * 17 + 5) % 41);
    $students[] = ['name' => $name, 'class' => $classes[$i % 6], 'level' => $level];
}

$subjects = [
    'Matematika (Wajib)' => [
        'short' => 'MTK Wajib',
        'adj' => -2,
        'topics' => ['Bilangan','Aljabar','Geometri','Trigonometri','Data & Peluang']
    ],
    'Bahasa Indonesia (Wajib)' => [
        'short' => 'B. Indo Wajib',
        'adj' => 0,
        'topics' => ['Info Tersurat','Mengelompokkan','Menyimpulkan','Menilai Gagasan','Menanggapi']
    ],
    'Bahasa Inggris (Wajib)' => [
        'short' => 'B. Inggris Wajib',
        'adj' => 1,
        'topics' => ['Info Eksplisit','Info Implisit','Menafsirkan','Menilai Makna']
    ],
    'Matematika Tingkat Lanjut' => [
        'short' => 'MTK Lanjut',
        'adj' => -5,
        'topics' => ['Fungsi Kompleks','Program Linear','Matriks','Transformasi','Stat. Lanjutan']
    ],
    'Bahasa Indonesia Tingkat Lanjut' => [
        'short' => 'B. Indo Lanjut',
        'adj' => -1,
        'topics' => ['Gagasan & Argumen','Koherensi & Kohesi','Makna Simbolik','Kualitas Penalaran']
    ],
    'Bahasa Inggris Tingkat Lanjut' => [
        'short' => 'B. Inggris Lanjut',
        'adj' => -2,
        'topics' => ['Membaca Kritis','Ide Abstrak','Validitas Argumen']
    ],
    'Fisika' => [
        'short' => 'Fisika',
        'adj' => -3,
        'topics' => ['Pengukuran','Gerak','Dinamika','Usaha & Energi','Gelombang','Listrik','Magnet','Termodinamika']
    ],
    'Kimia' => [
        'short' => 'Kimia',
        'adj' => -2,
        'topics' => ['Struktur Atom','Sistem Periodik','Ikatan Kimia','Reaksi Kimia','Stoikiometri','Larutan','Asam-Basa','Termokimia']
    ],
    'Biologi' => [
        'short' => 'Biologi',
        'adj' => 2,
        'topics' => ['Sel & Jaringan','Genetika','Ekologi','Sistem Organ','Evolusi','Bioteknologi']
    ],
    'Ekonomi' => [
        'short' => 'Ekonomi',
        'adj' => 3,
        'topics' => ['Prinsip Ekonomi','Ekonomi Mikro','Ekonomi Makro','Ekonomi Internasional','Akuntansi Dasar']
    ],
    'Geografi' => [
        'short' => 'Geografi',
        'adj' => 1,
        'topics' => ['Litosfer','Kependudukan','SIG','Mitigasi Bencana']
    ],
    'Sosiologi' => [
        'short' => 'Sosiologi',
        'adj' => 2,
        'topics' => ['Interaksi Sosial','Struktur Sosial','Perubahan Sosial','Lembaga Sosial','Penyimpangan Sosial']
    ],
    'Sejarah' => [
        'short' => 'Sejarah',
        'adj' => 1,
        'topics' => ['Periodisasi','Nasional & Dunia','Peradaban','Pergerakan Nasional']
    ],
];

function getTopicScore($studentIdx, $subjectIdx, $topicIdx, $level, $adj) {
    $variation = (($studentIdx * 7 + $subjectIdx * 13 + $topicIdx * 5) % 15) - 7;
    return max(0, min(100, $level + $adj + $variation));
}
@endphp
<div class="modern-card" style="margin-bottom:2rem;"><p style="color:var(--text-sub);">Sekolah: <strong>SMA NEGERI 1 HARAPAN BANGSA</strong> — KKM: {{ $kkm }} — Total Siswa: {{ count($students) }}</p></div>

@php $subjIdx = 0; @endphp
@foreach($subjects as $subjName => $subj)
@php
    $shortTopics = $subj['topics'];
    $subjIdx++;
@endphp
<div class="modern-card" style="margin-bottom:2rem;">
    <h3 style="color:var(--text-main);font-weight:700;margin-bottom:1rem;">{{ $subjName }}</h3>
    <div class="table-wrapper"><table>
        <thead><tr><th>Nama Siswa</th><th>Kelas</th>
            @foreach($shortTopics as $t)<th style="text-align:center;font-size:11px;">{{ $t }}</th>@endforeach
        </tr></thead>
        <tbody>
            @foreach($students as $i => $st)
            @php
                $scores = [];
                foreach ($shortTopics as $ti => $t) {
                    $scores[] = getTopicScore($i, $subjIdx, $ti, $st['level'], $subj['adj']);
                }
            @endphp
            <tr>
                <td style="font-weight:700;">{{ $st['name'] }}</td>
                <td>{{ $st['class'] }}</td>
                @foreach($scores as $s)
                    @php $red = $s < $kkm; @endphp
                    <td style="text-align:center;font-weight:800;{{ $red ? 'color:#dc2626;' : 'color:#059669;' }}">{{ number_format($s,1) }}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table></div>
</div>
@endforeach
<div style="margin-top:2rem;"><a href="/demo/sma/principal" style="color:#4f46e5;font-weight:700;font-size:0.875rem;text-decoration:none;">&larr; Kembali ke Dashboard</a></div>
@endsection
