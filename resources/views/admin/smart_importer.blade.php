@extends('layouts.app')

@section('title', 'Smart Importer - AI Learning')
@section('page_header', 'Mapping Wizard & Bulk Importer')
@section('page_subtitle', 'Daftarkan siswa secara massal ke Moodle dan alokasikan ke Course yang sesuai.')

@section('content')
<div style="display: grid; grid-template-columns: 1fr 2fr; gap: 2rem;">
    <!-- Upload Area Card -->
    <div style="display: flex; flex-direction: column; gap: 2rem;">
        <form action="{{ route('admin.smart_importer.preview') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
            @csrf
            <div class="modern-card">
                <h3 class="text-slate-800 font-bold mb-6">1. Unggah Data Siswa (CSV)</h3>
                <div onclick="document.getElementById('fileInput').click()" style="border: 2px dashed var(--border); border-radius: 24px; padding: 3rem 2rem; text-align: center; background: #f8fafc; transition: var(--transition); cursor: pointer;" onmouseover="this.style.borderColor='var(--primary)'; this.style.backgroundColor='#f5f3ff';" onmouseout="this.style.borderColor='var(--border)'; this.style.backgroundColor='#f8fafc';">
                    <div style="width: 64px; height: 64px; background: white; border-radius: 20px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; box-shadow: var(--shadow-md); color: var(--primary);">
                        <i data-lucide="upload-cloud" style="width: 32px; height: 32px;"></i>
                    </div>
                    <input type="file" name="file_csv" id="fileInput" style="display: none;" onchange="document.getElementById('uploadForm').submit()">
                    <p class="font-bold text-slate-800">Klik untuk pilih file CSV</p>
                    <p class="text-xs text-slate-500 mt-2">Mendukung pemisah koma ( , ) atau titik koma ( ; ) secara otomatis</p>
                </div>
                <div style="margin-top: 1.5rem;">
                    <a href="#" onclick="alert('Format Header CSV: nis;nama_depan;nama_belakang;email;password')" class="text-xs font-bold text-indigo-600 flex items-center gap-1" style="text-decoration: none;">
                        <i data-lucide="info" style="width: 14px;"></i> Info Format Header CSV
                    </a>
                </div>
            </div>
        </form>

        <div class="modern-card">
            <h3 class="text-slate-800 font-bold mb-6">2. Target Pendaftaran Siswa</h3>
            <div style="display: flex; flex-direction: column; gap: 1rem;">
                <label class="text-xs font-bold text-slate-500 uppercase">Pilih Rombongan Belajar / Course</label>
                <select name="target_id" form="processForm" required style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main);">
                    <option value="">-- Pilih Target --</option>
                    
                    <optgroup label="Berdasarkan Rombongan Belajar (Otomatis Sinkron)">
                        @foreach($classes as $class)
                            <option value="class_{{ $class->id }}">{{ $class->class_name }} ({{ $class->school->school_name }})</option>
                        @endforeach
                    </optgroup>

                    <optgroup label="Pilih Course Moodle Secara Manual">
                        @foreach($courses as $course)
                            <option value="course_{{ $course->id }}">{{ $course->fullname }}</option>
                        @endforeach
                    </optgroup>
                </select>
                @if(isset($previewData))
                <div class="glass" style="padding: 1rem; border-radius: 16px; border-left: 4px solid var(--primary);">
                    <p class="text-xs text-slate-500 font-bold">MODE: PREVIEW DATA</p>
                    <p class="text-xs text-slate-500">Jumlah Siswa Terdeteksi: <span class="font-bold text-slate-800">{{ count($previewData) }} Baris</span></p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Preview Area Card -->
    <div class="modern-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h3 class="text-slate-800 font-bold">Review & Sinkronisasi</h3>
            @if(isset($previewData))
            <form action="{{ route('admin.smart_importer.process') }}" method="POST" id="processForm">
                @csrf
                <input type="hidden" name="students_data" value="{{ json_encode($previewData) }}">
                <button type="submit" class="btn-indigo">
                    <i data-lucide="zap" style="width: 18px;"></i> Jalankan Sinkronisasi
                </button>
            </form>
            @endif
        </div>

        @if(session('success'))
            <div class="badge-success" style="margin-bottom: 1.5rem; padding: 1rem; border-radius: 12px;">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>NIS</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Password</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($previewData))
                        @foreach($previewData as $student)
                        <tr>
                            <td class="font-bold text-indigo-600">{{ $student['nis'] ?? '-' }}</td>
                            <td>{{ $student['nama_depan'] ?? '-' }} {{ $student['nama_belakang'] ?? '' }}</td>
                            <td class="text-slate-500 text-xs">{{ $student['email'] ?? '-' }}</td>
                            <td><span class="text-xs text-slate-400">••••••••</span></td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 4rem; color: #94a3b8;">
                                <i data-lucide="file-text" style="width: 48px; height: 48px; opacity: 0.2; display: block; margin: 0 auto 1rem;"></i>
                                Unggah file CSV untuk melihat pratinjau data di sini.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
