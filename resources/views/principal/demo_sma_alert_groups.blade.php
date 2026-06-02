@extends('layouts.app')
@section('title', 'Kelompok Alert SMA - Demo')
@section('page_header', 'Kelompok Topik Alert SMA')
@section('page_subtitle', 'Topik dengan siswa di bawah KKM (Demo SMA).')
@section('content')
<style>
    .dark .topic-card { background:rgba(220,38,38,0.1) !important; }
    .dark .topic-card h4 { color:#fca5a5 !important; }
    .dark .topic-card .student-count { color:var(--text-sub) !important; }
</style>
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

function getTS_ag($studentIdx, $subjectIdx, $topicIdx, $level, $adj) {
    return max(0, min(100, $level + $adj + ((($studentIdx * 7 + $subjectIdx * 13 + $topicIdx * 5) % 15) - 7)));
}

$subjKeys = array_keys($subjects);
@endphp
<div class="modern-card" style="margin-bottom:2rem;"><p style="color:var(--text-sub);">Sekolah: <strong>SMA NEGERI 1 HARAPAN BANGSA</strong> — KKM: {{ $kkm }}</p></div>
@foreach($subjects as $subjName => $subj)
@php
    $si = array_search($subjName, $subjKeys) + 1;
    $hasAnyAlert = false;
    $topicAlerts = [];
    foreach ($subj['topics'] as $ti => $t) {
        $alertStudents = [];
        foreach ($students as $sti => $st) {
            $s = getTS_ag($sti, $si, $ti, $st['level'], $subj['adj']);
            if ($s < $kkm) {
                $alertStudents[] = ['name' => $st['name'], 'class' => $st['class'], 'score' => $s];
            }
        }
        if (count($alertStudents) > 0) {
            $hasAnyAlert = true;
            $topicAlerts[$t] = $alertStudents;
        }
    }
@endphp
@if($hasAnyAlert)
<div class="modern-card" style="margin-bottom:2rem;border-left:4px solid #dc2626;">
    <h3 style="color:var(--text-main);font-weight:700;margin-bottom:1rem;">{{ $subjName }}</h3>
    @foreach($topicAlerts as $topic => $astudents)
    <div class="topic-card" style="margin-bottom:1.5rem;padding:1rem;background:#fef2f2;border-radius:12px;">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:0.75rem;">
            <h4 class="font-bold" style="color:#be123c;">{{ $topic }}</h4>
            <span class="student-count text-xs" style="color:#64748b;">{{ count($astudents) }} siswa</span>
        </div>
        <div class="table-wrapper"><table style="font-size:0.85rem;">
            <thead><tr><th>Nama Siswa</th><th style="text-align:center;width:120px;">Nilai</th></tr></thead>
            <tbody>
            @foreach($astudents as $as)
            <tr><td style="font-weight:700;">{{ $as['name'] }} <span style="color:var(--text-sub);font-weight:400;">({{ $as['class'] }})</span></td><td style="text-align:center;font-weight:800;color:#dc2626;">{{ number_format($as['score'],1) }}</td></tr>
            @endforeach
            </tbody>
        </table></div>
    </div>
    @endforeach
</div>
@endif
@endforeach
<div style="margin-top:2rem;"><a href="{{ url('/demo/sma/principal') }}" style="color:#4f46e5;font-weight:700;font-size:0.875rem;text-decoration:none;">&larr; Kembali ke Dashboard</a></div>
@endsection
