@extends('layouts.app')

@section('title', 'Manajemen Sekolah - AI Learning')
@section('page_header', 'Manajemen Organisasi')
@section('page_subtitle', 'Pilih sekolah untuk mengelola profil, periode akademik, dan hak akses.')

@section('content')
<div class="stat-group" style="margin-bottom: 2rem;">
    <div class="modern-card">
        <div class="text-xs font-bold text-slate-500 uppercase mb-1">Total Sekolah Mitra</div>
        <div class="text-3xl font-bold text-slate-800">12</div>
        <p class="text-xs text-slate-500 mt-2">Terdaftar di Sistem</p>
    </div>
    <div class="modern-card">
        <div class="text-xs font-bold text-slate-500 uppercase mb-1">Siswa Terintegrasi</div>
        <div class="text-3xl font-bold text-slate-800">1,284</div>
        <p class="text-xs text-emerald-600 mt-2 font-bold">Semua Aktif</p>
    </div>
</div>

<div class="modern-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h3 class="text-slate-800 font-bold">Daftar Sekolah & Institusi</h3>
        <button class="btn-indigo" onclick="window.location='{{ route('admin.school_setup') }}'" style="padding: 0.5rem 1rem;">
            <i data-lucide="plus" style="width: 16px;"></i> Registrasi Sekolah Baru
        </button>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Nama Sekolah</th>
                    <th>ID Organisasi</th>
                    <th>Tipe</th>
                    <th>Jumlah Siswa</th>
                    <th>Lokasi</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($schools as $school)
                <tr onclick="window.location='{{ route('admin.org_detail', $school->id) }}'" style="cursor: pointer;">
                    <td class="font-bold text-indigo-600">{{ $school->school_name }}</td>
                    <td>ORG-{{ str_pad($school->id, 3, '0', STR_PAD_LEFT) }}</td>
                    <td><span class="badge-primary">MITRA</span></td>
                    <td>0 Siswa</td>
                    <td>{{ Str::limit($school->address, 30) }}</td>
                    <td><span class="badge-success">ACTIVE</span></td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 2rem; color: #94a3b8;">
                        Belum ada sekolah terdaftar.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
