@extends('layouts.app')

@section('title', 'Manajemen Kelas - ' . $school->school_name)
@section('page_header', 'Rombongan Belajar')
@section('page_subtitle', 'Daftar struktur kelas untuk ' . $school->school_name)

@section('content')
<div style="margin-bottom: 2rem;">
    <a href="{{ route('admin.org_detail', $school->id) }}" class="text-indigo-600 font-bold text-sm" style="text-decoration:none;">&larr; Kembali ke Detail Sekolah</a>
</div>

<div class="modern-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h3 class="text-slate-800 font-bold">Daftar Kelas</h3>
        <button class="btn-indigo" onclick="document.getElementById('addClassModal').style.display='flex'">
            <i data-lucide="plus-circle" style="width: 18px;"></i> Tambah Kelas Baru
        </button>
    </div>

    @if(session('success'))
        <div class="badge-success" style="margin-bottom: 1.5rem; padding: 1rem; border-radius: 12px; width: 100%; text-align: center;">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Nama Kelas</th>
                    <th>Tautan Course Moodle</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($school->classes as $class)
                <tr>
                    <td class="font-bold">{{ $class->class_name }}</td>
                    <td>
                        @php $linkedCourse = $moodleCourses->where('id', $class->moodle_course_id)->first(); @endphp
                        @if($linkedCourse)
                            <span class="badge-primary" style="background: #eef2ff; color: #4f46e5; border: 1px solid #c7d2fe;">
                                <i data-lucide="link" style="width: 12px; display: inline; margin-right: 4px;"></i> {{ $linkedCourse->fullname }}
                            </span>
                        @else
                            <span class="text-xs text-slate-400 italic">Belum ditautkan</span>
                        @endif
                    </td>
                    <td style="text-align: center; display: flex; gap: 0.5rem; justify-content: center;">
                        <button class="btn-indigo" style="padding: 0.4rem; background: #f1f5f9; color: #475569;" 
                                onclick="openEditModal('{{ $class->id }}', '{{ $class->class_name }}', '{{ $class->moodle_course_id }}')">
                            <i data-lucide="edit-2" style="width: 16px;"></i>
                        </button>
                        <form action="{{ route('admin.class_delete', $class->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kelas {{ $class->class_name }}?')">
                            @csrf
                            <button class="btn-indigo" style="padding: 0.4rem; background: #fff1f2; color: #e11d48;">
                                <i data-lucide="trash-2" style="width: 16px;"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" style="text-align: center; padding: 3rem; color: #94a3b8;">
                        Belum ada kelas terdaftar untuk sekolah ini.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Add -->
<div id="addClassModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); backdrop-filter: blur(4px); z-index: 100; align-items: center; justify-content: center; padding: 2rem;">
    <div class="modern-card" style="width: 100%; max-width: 500px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h3 class="font-bold text-slate-800">Tambah Kelas Baru</h3>
            <button onclick="document.getElementById('addClassModal').style.display='none'" style="border:none; background:none; cursor:pointer;">
                <i data-lucide="x" style="width: 20px; color: var(--text-sub);"></i>
            </button>
        </div>
        <form action="{{ route('admin.class_store') }}" method="POST">
            @csrf
            <input type="hidden" name="school_id" value="{{ $school->id }}">
            <div style="margin-bottom: 1.5rem;">
                <label class="text-xs font-bold text-slate-500 uppercase block mb-2">Nama Kelas</label>
                <input type="text" name="class_name" placeholder="Contoh: Kelas 10-A" required style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main);">
            </div>
            <div style="margin-bottom: 2rem;">
                <label class="text-xs font-bold text-slate-500 uppercase block mb-2">Tautkan ke Course Moodle</label>
                <select name="moodle_course_id" style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main);">
                    <option value="">-- Tanpa Tautan --</option>
                    @foreach($moodleCourses as $course)
                        <option value="{{ $course->id }}">{{ $course->fullname }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn-indigo" style="width: 100%; justify-content: center; padding: 1rem;">Daftarkan Kelas</button>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div id="editClassModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); backdrop-filter: blur(4px); z-index: 100; align-items: center; justify-content: center; padding: 2rem;">
    <div class="modern-card" style="width: 100%; max-width: 500px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h3 class="font-bold text-slate-800">Edit Data Kelas</h3>
            <button onclick="document.getElementById('editClassModal').style.display='none'" style="border:none; background:none; cursor:pointer;">
                <i data-lucide="x" style="width: 20px; color: var(--text-sub);"></i>
            </button>
        </div>
        <form id="editClassForm" method="POST">
            @csrf
            <div style="margin-bottom: 1.5rem;">
                <label class="text-xs font-bold text-slate-500 uppercase block mb-2">Nama Kelas</label>
                <input type="text" name="class_name" id="edit_class_name" required style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main);">
            </div>
            <div style="margin-bottom: 2rem;">
                <label class="text-xs font-bold text-slate-500 uppercase block mb-2">Ganti Tautan Course Moodle</label>
                <select name="moodle_course_id" id="edit_moodle_course_id" style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main);">
                    <option value="">-- Tanpa Tautan --</option>
                    @foreach($moodleCourses as $course)
                        <option value="{{ $course->id }}">{{ $course->fullname }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn-indigo" style="width: 100%; justify-content: center; padding: 1rem;">Simpan Perubahan</button>
        </form>
    </div>
</div>

<script>
    function openEditModal(id, name, courseId) {
        document.getElementById('editClassForm').action = '/admin/class-update/' + id;
        document.getElementById('edit_class_name').value = name;
        document.getElementById('edit_moodle_course_id').value = courseId || "";
        document.getElementById('editClassModal').style.display = 'flex';
        lucide.createIcons();
    }
</script>
@endsection
