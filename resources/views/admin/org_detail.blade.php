@extends('layouts.app')

@section('title', 'Detail Sekolah - AI Learning')
@section('page_header', 'Detail Konfigurasi Sekolah')
@section('page_subtitle', 'Kelola profil sekolah spesifik, periode akademik, dan hak akses staf.')

@section('content')
<div style="margin-bottom: 2rem;">
    <a href="/admin/org-manager" class="text-indigo-600 font-bold text-sm" style="text-decoration:none;">&larr; Kembali ke Daftar Sekolah</a>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
    <!-- School Profile Summary -->
    <div class="modern-card" style="border-left: 4px solid var(--primary);">
        <div class="text-xs font-bold text-slate-500 uppercase mb-1">Status Sekolah</div>
        <div class="text-2xl font-bold text-slate-800">{{ $school->school_name }}</div>
        <p class="text-xs text-emerald-600 mt-2 font-bold">NPSN: {{ $school->npsn }} | {{ strtoupper($school->jenjang ?? '-') }}</p>
    </div>

    <!-- Rombongan Belajar Card -->
    <div class="modern-card" onclick="window.location='{{ route('admin.class_list', $school->id) }}'" style="cursor: pointer; border-left: 4px solid var(--success);">
        <div class="text-xs font-bold text-slate-500 uppercase mb-1">Rombongan Belajar</div>
        <div class="text-2xl font-bold text-slate-800">{{ $school->classes->count() }} Kelas</div>
        <p class="text-xs text-emerald-600 mt-2 font-bold">Klik untuk Kelola Kelas & Wali</p>
    </div>

    <!-- Total Pengguna Card -->
    <div class="modern-card" onclick="window.location='{{ route('admin.school_user_list', $school->id) }}'" style="cursor: pointer; border-left: 4px solid #f59e0b;">
        <div class="text-xs font-bold text-slate-500 uppercase mb-1">Pengguna AI</div>
        <div class="text-2xl font-bold text-slate-800">{{ count($users) }} Personel</div>
        <p class="text-xs text-amber-600 mt-2 font-bold">Manajemen RBAC</p>
    </div>

    <!-- Total Siswa Card -->
    <div class="modern-card" onclick="window.location='{{ route('admin.school_student_list', $school->id) }}'" style="cursor: pointer; border-left: 4px solid #3b82f6;">
        <div class="text-xs font-bold text-slate-500 uppercase mb-1">Siswa Terdaftar</div>
        <div class="text-2xl font-bold text-slate-800">{{ $studentCount }} Siswa</div>
        <p class="text-xs text-blue-600 mt-2 font-bold">Klik untuk Detail & Kelas</p>
    </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
    <!-- School Profile Card -->
    <div class="modern-card">
        <h3 class="text-slate-800 font-bold mb-6">Profil Sekolah</h3>
        <form action="{{ route('admin.school_update', $school->id) }}" method="POST" style="display: flex; flex-direction: column; gap: 1rem;">
            @csrf
            <div>
                <label class="text-xs font-bold text-slate-500 uppercase">Nama Sekolah</label>
                <input type="text" name="school_name" value="{{ $school->school_name }}" style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); margin-top: 0.5rem; background: var(--bg-card); color: var(--text-main);" required>
            </div>
            <div>
                <label class="text-xs font-bold text-slate-500 uppercase">NPSN</label>
                <input type="text" name="npsn" value="{{ $school->npsn }}" style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); margin-top: 0.5rem; background: var(--bg-card); color: var(--text-main);" required>
            </div>
            <div>
                <label class="text-xs font-bold text-slate-500 uppercase">Jenjang</label>
                <select name="jenjang" style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); margin-top: 0.5rem; background: var(--bg-card); color: var(--text-main);">
                    <option value="">-- Pilih --</option>
                    <option value="sd" {{ $school->jenjang == 'sd' ? 'selected' : '' }}>SD</option>
                    <option value="smp" {{ $school->jenjang == 'smp' ? 'selected' : '' }}>SMP</option>
                    <option value="sma" {{ $school->jenjang == 'sma' ? 'selected' : '' }}>SMA</option>
                </select>
            </div>
            <div>
                <label class="text-xs font-bold text-slate-500 uppercase">Alamat / Lokasi</label>
                <textarea name="address" rows="3" style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); margin-top: 0.5rem; background: var(--bg-card); color: var(--text-main);">{{ $school->address }}</textarea>
            </div>
            <button type="submit" class="btn-indigo" style="width: 100%; justify-content: center; margin-top: 0.5rem;">
                <i data-lucide="save" style="width: 16px;"></i> Simpan Profil
            </button>
        </form>
    </div>

    <!-- Academic Term Card -->
    <div class="modern-card">
        <h3 class="text-slate-800 font-bold mb-6">Tahun Ajaran & Term</h3>
        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
            <div style="padding: 1.25rem; background: #f5f3ff; border: 1px solid #e0e7ff; border-radius: 20px; display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <p class="font-bold text-indigo-600">Ganjil 2023/2024</p>
                    <p class="text-xs text-slate-500">Status: <span class="font-bold text-emerald-600">SEDANG BERJALAN</span></p>
                </div>
                <i data-lucide="check-circle-2" style="color: var(--success);"></i>
            </div>
            
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Term</th>
                            <th>Periode</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Ganjil 23/24</td>
                            <td class="text-xs">Jul 23 - Des 23</td>
                            <td><i data-lucide="more-horizontal" style="width: 18px; cursor: pointer;"></i></td>
                        </tr>
                        <tr>
                            <td>Genap 22/23</td>
                            <td class="text-xs">Jan 23 - Jun 23</td>
                            <td><i data-lucide="more-horizontal" style="width: 18px; cursor: pointer;"></i></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <button class="btn-indigo" style="background: white; color: var(--primary); border: 1px solid var(--primary); box-shadow: none;">+ Tambah Term</button>
        </div>
    </div>
</div>

<!-- School-Course Mapping Management -->
<div class="modern-card" style="margin-top: 2rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h3 class="text-slate-800 font-bold">Tautan Course Moodle</h3>
        <button onclick="document.getElementById('modalAddCourse').style.display='flex'" class="btn-indigo" style="font-size: 0.8rem; padding: 0.5rem 1rem;">
            <i data-lucide="link" style="width: 14px;"></i> Tambah Tautan
        </button>
    </div>

    @if($linkedCourses->isEmpty())
        <div style="text-align: center; padding: 2rem; border: 2px dashed var(--border); border-radius: 12px;">
            <p class="text-sm text-slate-500 font-bold">Belum ada Course Moodle yang ditautkan ke sekolah ini.</p>
        </div>
    @else
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; font-size: 0.85rem;">
                <thead style="background: var(--bg-main); color: var(--text-sub); text-transform: uppercase; font-size: 0.75rem;">
                    <tr>
                        <th style="padding: 1rem; text-align: left; border-radius: 10px 0 0 10px;">ID Course</th>
                        <th style="padding: 1rem; text-align: left;">Nama Course Moodle</th>
                        <th style="padding: 1rem; text-align: center; border-radius: 0 10px 10px 0;">Aksi</th>
                    </tr>
                </thead>
                <tbody style="color: var(--text-main);">
                    @foreach($linkedCourses as $lc)
                    <tr style="border-bottom: 1px solid var(--border);">
                        <td style="padding: 1rem; font-weight: bold;">#{{ $lc->id }}</td>
                        <td style="padding: 1rem;">{{ $lc->fullname }}</td>
                        <td style="padding: 1rem; text-align: center;">
                            <form action="{{ route('admin.link_course_delete', ['id' => $school->id, 'courseId' => $lc->id]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin memutus tautan course ini?');">
                                @csrf
                                <button type="submit" style="background: #fee2e2; color: #ef4444; border: none; padding: 0.4rem 0.8rem; border-radius: 8px; cursor: pointer; font-size: 0.75rem; font-weight: bold;">
                                    <i data-lucide="unlink" style="width: 12px; display: inline-block; vertical-align: middle;"></i> Putus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<!-- Modal Tambah Tautan Course -->
<div id="modalAddCourse" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center; backdrop-filter: blur(4px);">
    <div style="background: white; padding: 2rem; border-radius: 20px; width: 100%; max-width: 450px; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h3 class="font-bold text-lg text-slate-800">Tautkan Course Baru</h3>
            <button onclick="document.getElementById('modalAddCourse').style.display='none'" style="background: transparent; border: none; color: var(--text-sub); cursor: pointer;">
                <i data-lucide="x"></i>
            </button>
        </div>
        
        <form action="{{ route('admin.link_course_store', $school->id) }}" method="POST" style="display: flex; flex-direction: column; gap: 1rem;">
            @csrf
            <div>
                <label style="font-size: 0.8rem; font-weight: bold; color: var(--text-sub);">Pilih Mata Pelajaran (Course)</label>
                <select name="moodle_course_id" required style="width: 100%; padding: 0.8rem; border-radius: 12px; border: 1px solid var(--border); margin-top: 0.5rem;">
                    <option value="">-- Pilih Course Moodle --</option>
                    @foreach($allCourses as $c)
                        <option value="{{ $c->id }}">{{ $c->fullname }}</option>
                    @endforeach
                </select>
            </div>
            
            <button type="submit" class="btn-indigo" style="width: 100%; justify-content: center; margin-top: 1rem;">
                <i data-lucide="save" style="width: 16px;"></i> Simpan Tautan
            </button>
        </form>
    </div>
</div>

<script>
    if(typeof lucide !== 'undefined') { lucide.createIcons(); }
</script>
@endsection
