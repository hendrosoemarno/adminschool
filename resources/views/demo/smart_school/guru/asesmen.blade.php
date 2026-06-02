@extends('layouts.smart_school')

@section('title', 'Asesmen & Nilai - Smart School')
@section('page_header', 'Asesmen & Nilai')
@section('page_subtitle', 'Input dan kelola nilai asesmen siswa per topik.')
@section('breadcrumb')
<a href="{{ url('/demo/smart-school/guru') }}">Guru</a> / <a href="{{ url('/demo/smart-school/guru/asesmen') }}">Administrasi</a> / <span>Asesmen & Nilai</span>
@endsection

@section('styles')
<style>
    .filter-bar { display:flex; gap:1rem; align-items:center; flex-wrap:wrap; margin-bottom:1.5rem; }
    .filter-bar select { padding:0.6rem 1rem; border:1px solid var(--border); border-radius:12px; font-size:0.85rem; background:var(--bg-card); color:var(--text-main); outline:none; }
    .score-input { width:56px; padding:0.3rem 0.5rem; border:1px solid var(--border); border-radius:8px; text-align:center; font-size:0.8rem; font-weight:600; background:var(--bg-card); color:var(--text-main); outline:none; transition:border-color 0.2s; }
    .score-input:focus { border-color:var(--primary); }
    .score-low { color:var(--danger); }
    .score-high { color:var(--success); }
</style>
@endsection

@section('content')
<div class="modern-card">
    <div class="filter-bar">
        <i data-lucide="filter" style="width:18px;color:var(--text-sub);"></i>
        <select>
            <option value="">Semua Mapel</option>
            <option>Matematika Wajib</option>
            <option>Matematika Peminatan</option>
            <option>Fisika</option>
        </select>
        <select>
            <option value="">Semua Kelas</option>
            <option>XII IPA 1</option>
            <option>XII IPA 2</option>
            <option>XI IPA 1</option>
        </select>
        <select>
            <option value="">Semua Topik</option>
            <option>Topik A</option>
            <option>Topik B</option>
            <option>Topik C</option>
        </select>
        <button class="btn-indigo" onclick="alert('Demo: filter diterapkan');"><i data-lucide="search" style="width:16px;"></i> Tampilkan</button>
    </div>
</div>

<div class="modern-card" style="margin-top:1.25rem;">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1rem;">
        <h4 style="font-size:1rem;font-weight:700;"><i data-lucide="clipboard-list" style="width:18px;color:var(--primary);"></i> Daftar Nilai Siswa</h4>
        <span style="font-size:0.75rem;color:var(--text-sub);">KKM: 70</span>
    </div>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Topik A</th>
                    <th>Topik B</th>
                    <th>Topik C</th>
                    <th>Topik D</th>
                    <th>Topik E</th>
                    <th>Rata-rata</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $students = [
                        ['Ahmad Fauzi', 'XII IPA 1', 85, 78, 90, 65, 82],
                        ['Budi Santoso', 'XII IPA 1', 60, 72, 55, 80, 68],
                        ['Citra Dewi', 'XII IPA 1', 92, 88, 95, 78, 90],
                        ['Dian Permata', 'XII IPA 1', 45, 60, 58, 72, 50],
                        ['Eko Prasetyo', 'XII IPA 1', 78, 85, 72, 90, 80],
                        ['Fitri Handayani', 'XII IPA 1', 90, 85, 88, 92, 95],
                        ['Gilang Ramadhan', 'XII IPA 1', 55, 60, 65, 58, 62],
                        ['Hesti Wulandari', 'XII IPA 1', 80, 75, 82, 78, 85],
                        ['Indra Lesmana', 'XII IPA 1', 70, 68, 72, 60, 74],
                        ['Joko Susilo', 'XII IPA 1', 65, 58, 70, 55, 60],
                    ];
                @endphp
                @foreach($students as $i => $s)
                @php $avg = round(array_sum(array_slice($s,2)) / 5); @endphp
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td><strong>{{ $s[0] }}</strong></td>
                    <td>{{ $s[1] }}</td>
                    @foreach(array_slice($s,2) as $score)
                        <td><span class="{{ $score < 70 ? 'score-low' : 'score-high' }}">{{ $score }}</span></td>
                    @endforeach
                    <td><strong style="color:{{ $avg < 70 ? 'var(--danger)' : 'var(--success)' }};">{{ $avg }}</strong></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div style="margin-top:1.25rem; display:flex; justify-content:flex-end; gap:0.75rem;">
        <button class="btn-outline-sm" onclick="alert('Demo: reset nilai');"><i data-lucide="rotate-ccw" style="width:16px;"></i> Reset</button>
        <button class="btn-indigo" onclick="alert('Demo: nilai disimpan');"><i data-lucide="save" style="width:16px;"></i> Simpan Nilai</button>
    </div>
</div>
@endsection
