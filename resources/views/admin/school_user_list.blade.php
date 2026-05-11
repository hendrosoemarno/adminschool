@extends('layouts.app')

@section('title', 'Manajemen Personel - ' . $school->school_name)
@section('page_header', 'Manajemen Pengguna & RBAC')
@section('page_subtitle', 'Kelola personel sekolah dan hak akses AI untuk ' . $school->school_name)

@section('content')
<div style="margin-bottom: 2rem;">
    <a href="{{ route('admin.org_detail', $school->id) }}" class="text-indigo-600 font-bold text-sm" style="text-decoration:none;">&larr; Kembali ke Detail Sekolah</a>
</div>

<div class="modern-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <div>
            <h3 class="text-slate-800 font-bold">Daftar Personel Terdaftar</h3>
            <p class="text-xs text-slate-500">Personel yang memiliki akses ke platform analitik sekolah ini.</p>
        </div>
        <button class="btn-indigo" onclick="document.getElementById('addUserModal').style.display='flex'">
            <i data-lucide="user-plus" style="width: 18px;"></i> Tambah Personel Baru
        </button>
    </div>

    @if(session('success'))
        <div class="badge-success" style="margin-bottom: 1.5rem; padding: 1rem; border-radius: 12px; width: 100%; text-align: center;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabel 1: Kepala Sekolah -->
    <div style="margin-bottom: 3rem;">
        <h4 class="text-slate-700 font-bold mb-4" style="display: flex; align-items: center; gap: 0.5rem;">
            <i data-lucide="award" style="width: 20px; color: var(--primary);"></i> Kepala Sekolah
        </h4>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Nama Lengkap</th>
                        <th>Peran AI</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($principals as $user)
                    <tr>
                        <td class="font-bold">{{ $user->firstname }} {{ $user->lastname }}</td>
                        <td><span class="badge-indigo">KEPALA SEKOLAH</span></td>
                        <td style="text-align: center; display: flex; gap: 0.5rem; justify-content: center;">
                            <button class="btn-indigo" style="padding: 0.4rem; background: #f1f5f9; color: #475569;" onclick="openEditModal('{{ $user->id }}', '{{ $user->firstname }}', '{{ $user->lastname }}', '{{ $user->email }}')">
                                <i data-lucide="edit-2" style="width: 14px;"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="text-center text-slate-400 py-4">Belum ada Kepala Sekolah yang ditugaskan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tabel 2: Wali Kelas -->
    <div style="margin-bottom: 3rem;">
        <h4 class="text-slate-700 font-bold mb-4" style="display: flex; align-items: center; gap: 0.5rem;">
            <i data-lucide="home" style="width: 20px; color: var(--success);"></i> Wali Kelas
        </h4>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Nama Lengkap</th>
                        <th>Peran AI</th>
                        <th>Kelas</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($homerooms as $user)
                    <tr>
                        <td class="font-bold">{{ $user->firstname }} {{ $user->lastname }}</td>
                        <td><span class="badge-success" style="background: #f0fdf4; color: #16a34a;">WALI KELAS</span></td>
                        <td class="font-bold text-indigo-600">{{ $user->assigned_class }}</td>
                        <td style="text-align: center; display: flex; gap: 0.5rem; justify-content: center;">
                            <button class="btn-indigo" style="padding: 0.4rem; background: #f1f5f9; color: #475569;" onclick="openEditModal('{{ $user->id }}', '{{ $user->firstname }}', '{{ $user->lastname }}', '{{ $user->email }}')">
                                <i data-lucide="edit-2" style="width: 14px;"></i>
                            </button>
                            <form action="{{ route('admin.user_delete', $user->id) }}" method="POST" onsubmit="return confirm('Hapus penugasan wali kelas ini?')">
                                @csrf
                                <button class="btn-indigo" style="padding: 0.4rem; background: #fff1f2; color: #e11d48;">
                                    <i data-lucide="trash-2" style="width: 14px;"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center text-slate-400 py-4">Belum ada Wali Kelas yang ditugaskan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tabel 3: Guru Mapel -->
    <div>
        <h4 class="text-slate-700 font-bold mb-4" style="display: flex; align-items: center; gap: 0.5rem;">
            <i data-lucide="book-open" style="width: 20px; color: #db2777;"></i> Guru Mata Pelajaran
        </h4>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Nama Lengkap</th>
                        <th>Peran AI</th>
                        <th>Mata Pelajaran</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($teachers as $user)
                    <tr>
                        <td class="font-bold">{{ $user->firstname }} {{ $user->lastname }}</td>
                        <td><span class="badge-primary" style="background: #fdf2f8; color: #db2777;">GURU MAPEL</span></td>
                        <td class="font-bold text-amber-600">{{ $user->assigned_subject }}</td>
                        <td style="text-align: center; display: flex; gap: 0.5rem; justify-content: center;">
                            <button class="btn-indigo" style="padding: 0.4rem; background: #f1f5f9; color: #475569;" onclick="openEditModal('{{ $user->id }}', '{{ $user->firstname }}', '{{ $user->lastname }}', '{{ $user->email }}')">
                                <i data-lucide="edit-2" style="width: 14px;"></i>
                            </button>
                            <form action="{{ route('admin.user_delete', $user->id) }}" method="POST" onsubmit="return confirm('Hapus penugasan guru ini?')">
                                @csrf
                                <button class="btn-indigo" style="padding: 0.4rem; background: #fff1f2; color: #e11d48;">
                                    <i data-lucide="trash-2" style="width: 14px;"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center text-slate-400 py-4">Belum ada Guru Mapel yang ditugaskan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Add -->
<div id="addUserModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); backdrop-filter: blur(4px); z-index: 100; align-items: center; justify-content: center; padding: 2rem;">
    <div class="modern-card" style="width: 100%; max-width: 600px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h3 class="font-bold text-slate-800">Registrasi Personel Baru</h3>
            <button onclick="document.getElementById('addUserModal').style.display='none'" style="border:none; background:none; cursor:pointer;">
                <i data-lucide="x" style="width: 20px; color: var(--text-sub);"></i>
            </button>
        </div>
        <form action="{{ route('admin.user_store') }}" method="POST">
            @csrf
            <input type="hidden" name="school_id" value="{{ $school->id }}">
            
            <div style="display: flex; gap: 1.5rem; margin-bottom: 1.25rem;">
                <div style="flex: 1;">
                    <label class="text-xs font-bold text-slate-500 uppercase block mb-2">First Name</label>
                    <input type="text" name="firstname" required style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main); box-sizing: border-box;">
                </div>
                <div style="flex: 1;">
                    <label class="text-xs font-bold text-slate-500 uppercase block mb-2">Last Name</label>
                    <input type="text" name="lastname" required style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main); box-sizing: border-box;">
                </div>
            </div>

            <div style="margin-bottom: 1.25rem; display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div>
                    <label class="text-xs font-bold text-slate-500 uppercase block mb-2">Username</label>
                    <input type="text" name="username" required style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main); box-sizing: border-box;">
                </div>
                <div>
                    <label class="text-xs font-bold text-slate-500 uppercase block mb-2">Password</label>
                    <input type="password" name="password" required style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main); box-sizing: border-box;">
                </div>
            </div>

            <div style="margin-bottom: 1.25rem;">
                <label class="text-xs font-bold text-slate-500 uppercase block mb-2">Email Address</label>
                <input type="email" name="email" required style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main); box-sizing: border-box;">
            </div>

            <div style="margin-bottom: 1.25rem;">
                <label class="text-xs font-bold text-slate-500 uppercase block mb-2">Tugaskan Sebagai Peran (Role)</label>
                <select name="role" id="roleSelectorMain" onchange="toggleRoleFields()" style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main);" required>
                    <option value="member">Hanya User Moodle (Tanpa Jabatan)</option>
                    <option value="principal">Kepala Sekolah</option>
                    <option value="homeroom">Wali Kelas</option>
                    <option value="teacher">Guru Mata Pelajaran</option>
                </select>
            </div>

            <!-- Field khusus Wali Kelas -->
            <div id="homeroomFields" style="margin-bottom: 1.25rem; display: none;">
                <label class="text-xs font-bold text-slate-500 uppercase block mb-2">Pilih Kelas</label>
                <select name="class_id" style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main);">
                    @foreach($school->classes as $class)
                        <option value="{{ $class->id }}">{{ $class->class_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Field khusus Guru Mapel -->
            <div id="teacherFields" style="margin-bottom: 1.25rem; display: none;">
                <label class="text-xs font-bold text-slate-500 uppercase block mb-2">Mata Pelajaran yang Diampu</label>
                <select name="subject_id" style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main);">
                    @foreach(\App\Models\AiCompetencyReguler::all() as $mapel)
                        <option value="{{ $mapel->id }}">{{ $mapel->topic_name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn-indigo" style="width: 100%; justify-content: center; padding: 1rem; margin-top: 1rem;">Daftarkan & Beri Akses</button>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div id="editUserModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); backdrop-filter: blur(4px); z-index: 100; align-items: center; justify-content: center; padding: 2rem;">
    <div class="modern-card" style="width: 100%; max-width: 500px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h3 class="font-bold text-slate-800">Edit Data Personel</h3>
            <button onclick="document.getElementById('editUserModal').style.display='none'" style="border:none; background:none; cursor:pointer;">
                <i data-lucide="x" style="width: 20px; color: var(--text-sub);"></i>
            </button>
        </div>
        <form id="editUserForm" method="POST">
            @csrf
            <div style="display: flex; gap: 1.5rem; margin-bottom: 1.25rem;">
                <div style="flex: 1;">
                    <label class="text-xs font-bold text-slate-500 uppercase block mb-2">First Name</label>
                    <input type="text" name="firstname" id="edit_firstname" required style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main); box-sizing: border-box;">
                </div>
                <div style="flex: 1;">
                    <label class="text-xs font-bold text-slate-500 uppercase block mb-2">Last Name</label>
                    <input type="text" name="lastname" id="edit_lastname" required style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main); box-sizing: border-box;">
                </div>
            </div>
            <div style="margin-bottom: 2rem;">
                <label class="text-xs font-bold text-slate-500 uppercase block mb-2">Email</label>
                <input type="email" name="email" id="edit_email" required style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main); box-sizing: border-box;">
            </div>
            <button type="submit" class="btn-indigo" style="width: 100%; justify-content: center; padding: 1rem;">Simpan Perubahan</button>
        </form>
    </div>
</div>

<script>
    function openEditModal(id, first, last, email) {
        document.getElementById('editUserForm').action = '/admin/user-update/' + id;
        document.getElementById('edit_firstname').value = first;
        document.getElementById('edit_lastname').value = last;
        document.getElementById('edit_email').value = email;
        document.getElementById('editUserModal').style.display = 'flex';
        lucide.createIcons();
    }

    function toggleRoleFields() {
        const role = document.getElementById('roleSelectorMain').value;
        const homeroomFields = document.getElementById('homeroomFields');
        const teacherFields = document.getElementById('teacherFields');

        homeroomFields.style.display = (role === 'homeroom') ? 'block' : 'none';
        teacherFields.style.display = (role === 'teacher') ? 'block' : 'none';
    }
</script>
@endsection
