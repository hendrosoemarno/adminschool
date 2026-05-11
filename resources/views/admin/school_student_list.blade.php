@extends('layouts.app')

@section('title', 'Daftar Siswa - ' . $school->school_name)
@section('page_header', 'Daftar Siswa Terdaftar')
@section('page_subtitle', 'Seluruh siswa yang terdaftar dalam Rombongan Belajar di ' . $school->school_name)

@section('content')
<div style="margin-bottom: 2rem;">
    <a href="{{ route('admin.org_detail', $school->id) }}" class="text-indigo-600 font-bold text-sm" style="text-decoration:none;">&larr; Kembali ke Detail Sekolah</a>
</div>

<div class="modern-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h3 class="text-slate-800 font-bold">Data Siswa</h3>
        <div style="display: flex; gap: 1rem; align-items: center;">
            <div class="glass" style="padding: 0.5rem 1rem; border-radius: 12px; font-size: 0.8rem; font-weight: bold; color: var(--primary);">
                Total: {{ count($students) }} Siswa
            </div>
            <button class="btn-indigo" onclick="document.getElementById('addStudentModal').style.display='flex'">
                <i data-lucide="user-plus" style="width: 18px;"></i> Tambah Siswa Baru
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="badge-success" style="margin-bottom: 1.5rem; padding: 1rem; border-radius: 12px; width: 100%; text-align: center;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="badge-danger" style="margin-bottom: 1.5rem; padding: 1rem; border-radius: 12px; width: 100%; text-align: center; background: #fff1f2; color: #e11d48; border: 1px solid #fecaca;">
            {{ session('error') }}
        </div>
    @endif

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Nama Lengkap</th>
                    <th>Username (NIS)</th>
                    <th>Email</th>
                    <th>Rombongan Belajar (Kelas)</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                <tr>
                    <td class="font-bold text-slate-800">{{ $student->firstname }} {{ $student->lastname }}</td>
                    <td><code style="background: #f1f5f9; padding: 2px 6px; border-radius: 4px;">{{ $student->username }}</code></td>
                    <td class="text-slate-500 text-sm">{{ $student->email }}</td>
                    <td>
                        <span class="badge-primary" style="background: #e0f2fe; color: #0369a1; border: 1px solid #bae6fd;">
                            {{ $student->class_name }}
                        </span>
                    </td>
                    <td style="text-align: center; display: flex; gap: 0.5rem; justify-content: center;">
                        <button class="btn-indigo" style="padding: 0.4rem; background: #f1f5f9; color: #475569;" 
                                onclick="openEditModal('{{ $student->id }}', '{{ $student->firstname }}', '{{ $student->lastname }}', '{{ $student->email }}')">
                            <i data-lucide="edit-2" style="width: 16px;"></i>
                        </button>
                        <form action="{{ route('admin.student_delete', $student->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus siswa {{ $student->firstname }}?')">
                            @csrf
                            <button class="btn-indigo" style="padding: 0.4rem; background: #fff1f2; color: #e11d48;">
                                <i data-lucide="trash-2" style="width: 16px;"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 4rem; color: #94a3b8;">
                        <i data-lucide="users" style="width: 48px; height: 48px; opacity: 0.1; display: block; margin: 0 auto 1rem;"></i>
                        Belum ada siswa yang terdaftar di kelas manapun untuk sekolah ini.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Edit Siswa -->
<div id="editStudentModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); backdrop-filter: blur(4px); z-index: 100; align-items: center; justify-content: center; padding: 2rem;">
    <div class="modern-card" style="width: 100%; max-width: 500px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h3 class="font-bold text-slate-800">Edit Profil Siswa</h3>
            <button onclick="document.getElementById('editStudentModal').style.display='none'" style="border:none; background:none; cursor:pointer;">
                <i data-lucide="x" style="width: 20px; color: var(--text-sub);"></i>
            </button>
        </div>
        <form id="editStudentForm" method="POST">
            @csrf
            <div style="display: flex; gap: 1.5rem; margin-bottom: 1.5rem; flex-wrap: wrap;">
                <div style="flex: 1; min-width: 200px;">
                    <label class="text-xs font-bold text-slate-500 uppercase block mb-2">Nama Depan</label>
                    <input type="text" name="firstname" id="edit_firstname" required style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main); box-sizing: border-box;">
                </div>
                <div style="flex: 1; min-width: 200px;">
                    <label class="text-xs font-bold text-slate-500 uppercase block mb-2">Nama Belakang</label>
                    <input type="text" name="lastname" id="edit_lastname" style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main); box-sizing: border-box;">
                </div>
            </div>
            <div style="margin-bottom: 2rem;">
                <label class="text-xs font-bold text-slate-500 uppercase block mb-2">Email</label>
                <input type="email" name="email" id="edit_email" required style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main); box-sizing: border-box;">
            </div>
            <button type="submit" class="btn-indigo" style="width: 100%; justify-content: center; padding: 1rem;">Simpan Perubahan Siswa</button>
        </form>
    </div>
</div>

<!-- Modal Tambah Siswa -->
<div id="addStudentModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); backdrop-filter: blur(4px); z-index: 100; align-items: center; justify-content: center; padding: 2rem;">
    <div class="modern-card" style="width: 100%; max-width: 600px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h3 class="font-bold text-slate-800">Daftarkan Siswa Baru</h3>
            <button onclick="document.getElementById('addStudentModal').style.display='none'" style="border:none; background:none; cursor:pointer;">
                <i data-lucide="x" style="width: 20px; color: var(--text-sub);"></i>
            </button>
        </div>
        <form action="{{ route('admin.student_store') }}" method="POST">
            @csrf
            <div style="display: flex; gap: 1.5rem; margin-bottom: 1.5rem; flex-wrap: wrap;">
                <div style="flex: 1; min-width: 200px;">
                    <label class="text-xs font-bold text-slate-500 uppercase block mb-2">Nama Depan</label>
                    <input type="text" name="firstname" required style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main); box-sizing: border-box;">
                </div>
                <div style="flex: 1; min-width: 200px;">
                    <label class="text-xs font-bold text-slate-500 uppercase block mb-2">Nama Belakang</label>
                    <input type="text" name="lastname" style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main); box-sizing: border-box;">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                <div>
                    <label class="text-xs font-bold text-slate-500 uppercase block mb-2">Username (NIS)</label>
                    <input type="text" name="username" required style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main);">
                </div>
                <div>
                    <label class="text-xs font-bold text-slate-500 uppercase block mb-2">Password</label>
                    <input type="password" name="password" required placeholder="Min. 8 Karakter" style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main);">
                </div>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label class="text-xs font-bold text-slate-500 uppercase block mb-2">Email</label>
                <input type="email" name="email" required style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main);">
            </div>

            <div style="margin-bottom: 2rem;">
                <label class="text-xs font-bold text-slate-500 uppercase block mb-2">Pilih Rombongan Belajar (Kelas)</label>
                <select name="class_id" required style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main);">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach($school->classes as $class)
                        <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn-indigo" style="width: 100%; justify-content: center; padding: 1rem;">Daftarkan Siswa Sekarang</button>
        </form>
    </div>
</div>

<script>
    function openEditModal(id, fname, lname, email) {
        document.getElementById('editStudentForm').action = '/admin/student-update/' + id;
        document.getElementById('edit_firstname').value = fname;
        document.getElementById('edit_lastname').value = lname;
        document.getElementById('edit_email').value = email;
        document.getElementById('editStudentModal').style.display = 'flex';
        lucide.createIcons();
    }
</script>
@endsection
