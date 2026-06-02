@extends('layouts.smart_school')

@section('title', 'Presensi Siswa - Smart School')
@section('page_header', 'Presensi Siswa')
@section('page_subtitle', 'Catat kehadiran siswa harian dengan cepat.')
@section('breadcrumb')
<a href="{{ url('/demo/smart-school/guru') }}">Guru</a> / <a href="{{ url('/demo/smart-school/guru/presensi') }}">Administrasi</a> / <span>Presensi</span>
@endsection

@section('styles')
<style>
    .filter-bar { display:flex; gap:1rem; align-items:center; flex-wrap:wrap; margin-bottom:1.5rem; }
    .filter-bar select, .filter-bar input { padding:0.6rem 1rem; border:1px solid var(--border); border-radius:12px; font-size:0.85rem; background:var(--bg-card); color:var(--text-main); outline:none; }
    .status-badge { display:inline-block; padding:0.25rem 0.75rem; border-radius:9999px; font-size:0.7rem; font-weight:700; cursor:pointer; border:none; transition:all 0.2s; font-family:'Inter',sans-serif; }
    .status-hadir { background:#05966915; color:var(--success); }
    .status-sakit { background:#d9770615; color:var(--warning); }
    .status-izin { background:#4f46e515; color:var(--primary); }
    .status-alfa { background:#dc262615; color:var(--danger); }
    .status-hadir:hover { background:var(--success); color:#fff; }
    .status-sakit:hover { background:var(--warning); color:#fff; }
    .status-izin:hover { background:var(--primary); color:#fff; }
    .status-alfa:hover { background:var(--danger); color:#fff; }
</style>
@endsection

@section('content')
<div class="modern-card">
    <div class="filter-bar">
        <i data-lucide="filter" style="width:18px;color:var(--text-sub);"></i>
        <select>
            <option>XII IPA 1</option>
            <option>XII IPA 2</option>
            <option>XI IPA 1</option>
            <option>XI IPA 2</option>
            <option>X IPA 1</option>
        </select>
        <input type="date" value="2026-05-27">
        <button class="btn-indigo" onclick="alert('Demo: filter presensi');"><i data-lucide="search" style="width:16px;"></i> Tampilkan</button>
    </div>
</div>

<div class="modern-card" style="margin-top:1.25rem;">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1rem;">
        <h4 style="font-size:1rem;font-weight:700;"><i data-lucide="users" style="width:18px;color:var(--primary);"></i> Daftar Kehadiran</h4>
        <div style="display:flex;gap:0.75rem;font-size:0.7rem;color:var(--text-sub);">
            <span><span style="display:inline-block;width:10px;height:10px;border-radius:50%;background:var(--success);margin-right:0.3rem;"></span> Hadir</span>
            <span><span style="display:inline-block;width:10px;height:10px;border-radius:50%;background:var(--warning);margin-right:0.3rem;"></span> Sakit</span>
            <span><span style="display:inline-block;width:10px;height:10px;border-radius:50%;background:var(--primary);margin-right:0.3rem;"></span> Izin</span>
            <span><span style="display:inline-block;width:10px;height:10px;border-radius:50%;background:var(--danger);margin-right:0.3rem;"></span> Alfa</span>
        </div>
    </div>
    <div class="table-wrapper">
        <table>
            <thead><tr><th>No</th><th>Nama</th><th>Status</th></tr></thead>
            <tbody>
                @php
                    $presensiSiswa = [
                        ['Ahmad Fauzi', 'Hadir'],
                        ['Budi Santoso', 'Hadir'],
                        ['Citra Dewi', 'Hadir'],
                        ['Dian Permata', 'Sakit'],
                        ['Eko Prasetyo', 'Hadir'],
                        ['Fitri Handayani', 'Hadir'],
                        ['Gilang Ramadhan', 'Izin'],
                        ['Hesti Wulandari', 'Hadir'],
                        ['Indra Lesmana', 'Alfa'],
                        ['Joko Susilo', 'Hadir'],
                    ];
                @endphp
                @foreach($presensiSiswa as $i => $ps)
                @php
                    $statusClass = match($ps[1]) {
                        'Hadir' => 'status-hadir',
                        'Sakit' => 'status-sakit',
                        'Izin' => 'status-izin',
                        'Alfa' => 'status-alfa',
                        default => 'status-hadir'
                    };
                @endphp
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td><strong>{{ $ps[0] }}</strong></td>
                    <td>
                        <button class="status-badge {{ $statusClass }}" onclick="alert('Demo: ubah status presensi');">{{ $ps[1] }}</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div style="margin-top:1.25rem; display:flex; justify-content:flex-end; gap:0.75rem;">
        <button class="btn-outline-sm" onclick="alert('Demo: reset presensi');"><i data-lucide="rotate-ccw" style="width:16px;"></i> Reset</button>
        <button class="btn-indigo" onclick="alert('Demo: presensi disimpan');"><i data-lucide="save" style="width:16px;"></i> Simpan Presensi</button>
    </div>
</div>
@endsection
