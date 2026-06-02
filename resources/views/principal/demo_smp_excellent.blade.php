@extends('layouts.app')
@section('title', 'Siswa Excellent SMP - Demo')
@section('page_header', 'Siswa dengan Capaian Excellent SMP')
@section('page_subtitle', 'Daftar siswa yang mencapai target sekolah (≥ 75).')
@section('content')
<div class="modern-card" style="margin-bottom:2rem;"><p style="color:var(--text-sub);">Sekolah: <strong>SMP NEGERI 1 HARAPAN BANGSA</strong> — Target: ≥ 75</p></div>
<div class="modern-card">
    <h3 style="color:var(--text-main);font-weight:700;margin-bottom:1rem;">Daftar Siswa Excellent</h3>
    <div class="table-wrapper"><table>
        <thead><tr><th>Nama Siswa</th><th>Kelas</th><th style="text-align:center;">Matematika</th><th style="text-align:center;">B. Indonesia</th></tr></thead>
        <tbody>
            <tr><td style="font-weight:700;">Aisyah Humaira</td><td>7A</td><td style="text-align:center;font-weight:800;color:#059669;">85.2</td><td style="text-align:center;font-weight:800;color:#059669;">88.5</td></tr>
            <tr><td style="font-weight:700;">Zahra Safiya</td><td>7A</td><td style="text-align:center;font-weight:800;color:#059669;">82.1</td><td style="text-align:center;font-weight:800;color:#059669;">84.7</td></tr>
            <tr><td style="font-weight:700;">Muhammad Fayyadh</td><td>7B</td><td style="text-align:center;font-weight:800;color:#059669;">78.4</td><td style="text-align:center;font-weight:800;color:#059669;">80.2</td></tr>
            <tr><td style="font-weight:700;">Layla Najwa</td><td>7A</td><td style="text-align:center;font-weight:800;color:#059669;">79.8</td><td style="text-align:center;font-weight:800;color:#059669;">82.4</td></tr>
            <tr><td style="font-weight:700;">Hafsa Arumi</td><td>7C</td><td style="text-align:center;font-weight:800;color:#059669;">76.2</td><td style="text-align:center;font-weight:800;color:#059669;">78.9</td></tr>
        </tbody>
    </table></div>
</div>
<div style="margin-top:2rem;"><a href="/demo/smp/principal" style="color:#4f46e5;font-weight:700;font-size:0.875rem;text-decoration:none;">&larr; Kembali ke Dashboard</a></div>
@endsection
