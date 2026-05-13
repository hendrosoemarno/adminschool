@extends('layouts.app')
@section('title', 'Detail Mastery - Demo')
@section('page_header', 'Detail Rata-rata Mastery Siswa')
@section('page_subtitle', 'Daftar siswa beserta nilai per mata pelajaran (Demo).')
@section('content')
<div class="modern-card" style="margin-bottom:2rem;"><p class="text-slate-500">Sekolah: <strong>SD NEGERI 1 HARAPAN BANGSA</strong></p></div>
<div class="modern-card">
    <h3 class="text-slate-800 font-bold mb-4">Daftar Siswa & Nilai</h3>
    <div class="table-wrapper"><table>
        <thead><tr><th>Nama Siswa</th><th>Kelas</th><th style="text-align:center;">Matematika</th><th style="text-align:center;">B. Indonesia</th></tr></thead>
        <tbody>
            <tr><td class="font-bold">Aisyah Humaira</td><td>6A</td><td style="text-align:center;font-weight:800;color:#059669;">85.2</td><td style="text-align:center;font-weight:800;color:#059669;">88.5</td></tr>
            <tr><td class="font-bold">Zahra Safiya</td><td>6A</td><td style="text-align:center;font-weight:800;color:#059669;">82.1</td><td style="text-align:center;font-weight:800;color:#059669;">84.7</td></tr>
            <tr><td class="font-bold">Muhammad Fayyadh</td><td>6B</td><td style="text-align:center;font-weight:800;color:#059669;">78.4</td><td style="text-align:center;font-weight:800;color:#059669;">80.2</td></tr>
            <tr><td class="font-bold">Kayla Nadhira</td><td>6B</td><td style="text-align:center;font-weight:800;color:#d97706;">71.5</td><td style="text-align:center;font-weight:800;color:#059669;">76.3</td></tr>
            <tr><td class="font-bold">Layla Najwa</td><td>6A</td><td style="text-align:center;font-weight:800;color:#059669;">79.8</td><td style="text-align:center;font-weight:800;color:#059669;">82.4</td></tr>
            <tr><td class="font-bold">Hafsa Arumi</td><td>6C</td><td style="text-align:center;font-weight:800;color:#059669;">76.2</td><td style="text-align:center;font-weight:800;color:#059669;">78.9</td></tr>
        </tbody>
    </table></div>
</div>
<div style="margin-top:2rem;"><a href="/demo/principal" class="text-indigo-600 font-bold text-sm" style="text-decoration:none;">&larr; Kembali ke Dashboard</a></div>
@endsection
