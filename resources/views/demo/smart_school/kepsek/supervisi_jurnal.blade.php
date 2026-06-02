@extends('layouts.smart_school')

@section('title', 'Supervisi Jurnal & Presensi')
@section('page_header', 'Supervisi Jurnal')
@section('page_subtitle', 'Monitoring jurnal harian dan presensi guru')
@section('breadcrumb')
<a href="{{ url('/demo/smart-school/kepsek') }}">Kepsek</a> / <a href="{{ url('/demo/smart-school/kepsek/supervisi-jurnal') }}">Monitoring</a> / <span>Supervisi Jurnal</span>
@endsection

@section('content')

<!-- Filter Bar -->
<div class="modern-card" style="margin-bottom:2rem;">
    <div style="display:flex;gap:1rem;align-items:end;flex-wrap:wrap;">
        <div style="flex:1;min-width:180px;">
            <label style="display:block;font-size:0.7rem;font-weight:700;color:var(--text-sub);margin-bottom:0.35rem;">Nama Guru</label>
            <select style="width:100%;padding:0.6rem 0.75rem;border-radius:12px;border:1px solid var(--border);background:var(--bg-card);color:var(--text-main);font-size:0.85rem;">
                <option>Semua Guru</option>
                <option>Dewi Sartika</option>
                <option>Ahmad Fauzi</option>
                <option>Siti Rahmawati</option>
                <option>Bambang Supriyadi</option>
                <option>Rina Marlina</option>
            </select>
        </div>
        <div style="flex:1;min-width:180px;">
            <label style="display:block;font-size:0.7rem;font-weight:700;color:var(--text-sub);margin-bottom:0.35rem;">Tanggal</label>
            <input type="date" value="2026-05-27" style="width:100%;padding:0.6rem 0.75rem;border-radius:12px;border:1px solid var(--border);background:var(--bg-card);color:var(--text-main);font-size:0.85rem;">
        </div>
        <button class="btn-indigo" onclick="alert('Demo')"><i data-lucide="search" style="width:16px;"></i> Cari</button>
        <button class="btn-outline-sm" onclick="alert('Reset')"><i data-lucide="rotate-ccw" style="width:14px;"></i> Reset</button>
    </div>
</div>

<!-- Timeline Jurnal -->
<h3 style="font-size:1rem;font-weight:700;margin-bottom:1rem;">Jurnal Harian Guru</h3>
<div style="display:grid;gap:1rem;margin-bottom:2rem;">
    @php
        $entries = [
            ['Dewi Sartika', '12A', 'Matematika', '2026-05-27', 'Fungsi Trigonometri dan turunannya', 'Lengkap', 'Membahas rumus sin, cos, tan. Siswa mengerjakan latihan soal. Kendala: beberapa siswa masih bingung grafik. Solusi: remedial kecil.', ['Rina', 'Ahmad', 'Siti'], ['Budi (sakit)', ''],
            ['Ahmad Fauzi', '11B', 'Bahasa Inggris', '2026-05-27', 'Passive Voice dalam 16 tenses', 'Lengkap', 'Teori dan contoh kalimat. Latihan kelompok. Kendala: siswa sulit mengkonversi tenses. Solusi: drilling tambahan.', ['Dodi', 'Eka', 'Fajar', 'Gita'], ['Hani (izin)'],
            ['Siti Rahmawati', '10A', 'IPA', '2026-05-27', 'Gelombang Elektromagnetik', 'Kurang', 'Materi belum selesai. Hanya membahas definisi dan spektrum.', ['Adi', 'Bella', 'Cindy'], ['Dimas', 'Edo (alfa)', 'Fitri'],
            ['Rina Marlina', '12B', 'IPS', '2026-05-26', 'Perekonomian Global dan Dampaknya', 'Lengkap', 'Diskusi tentang globalisasi ekonomi. Presentasi kelompok. Semua aktif.', ['Gilang', 'Hana', 'Ivan', 'Joko'], [''],
            ['Bambang Supriyadi', '11A', 'PKN', '2026-05-26', 'HAM dalam Konstitusi', 'Kurang', 'Materi disampaikan setengah. Banyak siswa tidak konsentrasi.', ['Kevin', 'Lia', 'Mega'], ['Nando (alfa)', 'Oliv (alfa)'],
        ];
    @endphp
    @foreach($entries as $e)
    <div class="modern-card" style="position:relative;padding-left:2rem;">
        <div style="position:absolute;left:0;top:1.5rem;bottom:1.5rem;width:3px;background:{{ $e[5] === 'Lengkap' ? 'var(--success)' : 'var(--warning)' }};border-radius:9999px;"></div>
        <div style="position:absolute;left:-6px;top:1.5rem;width:15px;height:15px;border-radius:50%;background:{{ $e[5] === 'Lengkap' ? 'var(--success)' : 'var(--warning)' }};border:3px solid var(--bg-card);"></div>
        <div style="display:flex;justify-content:space-between;align-items:start;margin-bottom:0.5rem;flex-wrap:wrap;gap:0.5rem;">
            <div>
                <span style="font-weight:700;">{{ $e[0] }}</span>
                <span style="font-size:0.75rem;color:var(--text-sub);margin-left:0.75rem;">{{ $e[1] }} &middot; {{ $e[2] }}</span>
            </div>
            <div style="display:flex;gap:0.75rem;align-items:center;">
                <span style="font-size:0.7rem;color:var(--text-sub);">{{ $e[3] }}</span>
                <span class="{{ $e[5] === 'Lengkap' ? 'badge-green' : 'badge-yellow' }}">{{ $e[5] }}</span>
            </div>
        </div>
        <div style="font-size:0.85rem;color:var(--text-main);margin-bottom:0.75rem;">{{ $e[4] }}</div>
        <div style="font-size:0.75rem;color:var(--text-sub);margin-bottom:0.5rem;"><strong style="color:var(--text-main);">Detail:</strong> {{ $e[6] }}</div>
        <div style="display:flex;gap:1.5rem;font-size:0.75rem;flex-wrap:wrap;">
            <div style="display:flex;align-items:center;gap:0.35rem;"><span style="color:var(--success);font-weight:600;">Hadir:</span> {{ implode(', ', $e[7]) }}</div>
            @if($e[8][0] !== '')
            <div style="display:flex;align-items:center;gap:0.35rem;"><span style="color:var(--danger);font-weight:600;">Absen:</span> {{ implode(', ', array_filter($e[8])) }}</div>
            @endif
        </div>
    </div>
    @endforeach
</div>

<!-- Rekapitulasi -->
<div class="modern-card">
    <h3 style="font-size:1rem;font-weight:700;margin-bottom:1rem;">Rekapitulasi Jurnal Bulan Ini</h3>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr><th>Nama Guru</th><th>Jml Jurnal Bulan Ini</th><th>Terakhir Input</th><th>Status</th></tr>
            </thead>
            <tbody>
                @php
                    $rekap = [
                        ['Dewi Sartika', 22, '2026-05-27', 'Aktif'],
                        ['Ahmad Fauzi', 18, '2026-05-27', 'Aktif'],
                        ['Siti Rahmawati', 15, '2026-05-26', 'Kurang'],
                        ['Bambang Supriyadi', 10, '2026-05-24', 'Pasif'],
                        ['Rina Marlina', 20, '2026-05-27', 'Aktif'],
                        ['Hendra Gunawan', 12, '2026-05-25', 'Kurang'],
                    ];
                @endphp
                @foreach($rekap as $r)
                <tr>
                    <td style="font-weight:600;">{{ $r[0] }}</td>
                    <td>{{ $r[1] }}</td>
                    <td>{{ $r[2] }}</td>
                    <td><span class="badge-{{ $r[3] === 'Aktif' ? 'green' : ($r[3] === 'Kurang' ? 'yellow' : 'red') }}">{{ $r[3] }}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('scripts')
<script>try { lucide.createIcons(); } catch(e) {}</script>
@endsection
