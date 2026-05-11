@extends('layouts.app')

@section('title', 'Penugasan Peran AI - AI Learning')
@section('page_header', 'Manajemen Role & Akses AI')
@section('page_subtitle', 'Hubungkan User Moodle ke posisi strategis di ekosistem AI Learning.')

@section('content')
<div style="display: grid; grid-template-columns: 1fr 1.5fr; gap: 2rem;">
    
    <!-- Assignment Form -->
    <div class="modern-card">
        <h3 class="text-slate-800 font-bold mb-6">Tugaskan Peran Baru</h3>
        
        @if(session('success'))
            <div class="badge-success" style="margin-bottom: 1.5rem; padding: 1rem; border-radius: 12px; width: 100%; text-align: center;">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.role_store') }}" method="POST">
            @csrf
            <div style="margin-bottom: 1.5rem;">
                <label class="text-xs font-bold text-slate-500 uppercase block mb-2">1. Pilih User Moodle</label>
                <select name="user_id" style="width: 100%; padding: 0.75rem 1rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main);" required>
                    <option value="">-- Pilih Nama User --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->firstname }} {{ $user->lastname }} ({{ $user->email }})</option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label class="text-xs font-bold text-slate-500 uppercase block mb-2">2. Pilih Peran AI</label>
                <select name="role" id="roleSelector" style="width: 100%; padding: 0.75rem 1rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main);" required onchange="toggleAssignmentOptions()">
                    <option value="">-- Pilih Peran --</option>
                    <option value="principal">Kepala Sekolah</option>
                    <option value="homeroom">Wali Kelas</option>
                    <option value="teacher">Guru Mata Pelajaran</option>
                </select>
            </div>

            <!-- Conditional Options for Principal -->
            <div id="schoolOption" style="margin-bottom: 1.5rem; display: none;">
                <label class="text-xs font-bold text-slate-500 uppercase block mb-2">3. Pilih Sekolah</label>
                <select name="school_id" style="width: 100%; padding: 0.75rem 1rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main);">
                    @foreach($schools as $school)
                        <option value="{{ $school->id }}">{{ $school->school_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Conditional Options for Homeroom -->
            <div id="classOption" style="margin-bottom: 1.5rem; display: none;">
                <label class="text-xs font-bold text-slate-500 uppercase block mb-2">3. Pilih Kelas</label>
                <select name="class_id" style="width: 100%; padding: 0.75rem 1rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main);">
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}">{{ $class->class_name }} ({{ $class->school->school_name ?? 'N/A' }})</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn-indigo" style="width: 100%; justify-content: center; padding: 1rem; margin-top: 1rem;">
                <i data-lucide="shield-check" style="width: 18px;"></i> Simpan Penugasan
            </button>
        </form>
    </div>

    <!-- Active Roles Table -->
    <div class="modern-card">
        <div style="display: flex; justify-content: space-between; align-items: center; mb-6">
            <h3 class="text-slate-800 font-bold">Daftar Pemegang Role Aktif</h3>
            <span class="badge-primary">Live Monitoring</span>
        </div>
        <div class="table-wrapper" style="margin-top: 1.5rem;">
            <table>
                <thead>
                    <tr>
                        <th>Nama User</th>
                        <th>Peran</th>
                        <th>Unit Tugas</th>
                        <th style="text-align: center;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Row for Principal -->
                    @foreach($schools as $school)
                        @if($school->principal_name)
                        <tr>
                            <td class="font-bold">User ID: {{ $school->principal_name }}</td>
                            <td><span class="badge-indigo">KEPSEK</span></td>
                            <td>{{ $school->school_name }}</td>
                            <td style="text-align: center;"><span class="badge-success">ACTIVE</span></td>
                        </tr>
                        @endif
                    @endforeach

                    <!-- Row for Homeroom -->
                    @foreach($classes as $class)
                        @if($class->homeroom_moodle_user_id)
                        <tr>
                            <td class="font-bold">User ID: {{ $class->homeroom_moodle_user_id }}</td>
                            <td><span class="badge-success" style="background: #dcfce7; color: #15803d;">WALI KELAS</span></td>
                            <td>{{ $class->class_name }}</td>
                            <td style="text-align: center;"><span class="badge-success">ACTIVE</span></td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function toggleAssignmentOptions() {
        const role = document.getElementById('roleSelector').value;
        const schoolOption = document.getElementById('schoolOption');
        const classOption = document.getElementById('classOption');

        schoolOption.style.display = (role === 'principal') ? 'block' : 'none';
        classOption.style.display = (role === 'homeroom') ? 'block' : 'none';
    }
</script>
@endsection
