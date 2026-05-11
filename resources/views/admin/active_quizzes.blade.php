@extends('layouts.app')

@section('title', 'Daftar Kuis Aktif - AI Learning')
@section('page_header', 'Daftar Kuis Aktif')
@section('page_subtitle', 'Seluruh kuis yang sedang berjalan dan terintegrasi dengan pemetaan kompetensi.')

@section('content')
<div class="modern-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h3 class="text-slate-800 font-bold">Monitor Kuis Berjalan</h3>
        <button class="btn-indigo" onclick="document.getElementById('allocateModal').style.display='flex'" style="padding: 0.5rem 1rem;">
            <i data-lucide="plus" style="width: 16px;"></i> Alokasikan Kuis Baru
        </button>
    </div>

    @if(session('success'))
        <div style="background: #ecfdf5; color: #065f46; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Nama Kuis (Moodle)</th>
                    <th>Mata Pelajaran</th>
                    <th>Kategori</th>
                    <th>Waktu Aktif</th>
                    <th>Batas Pengerjaan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($allocations as $alloc)
                <tr>
                    <td class="font-bold">{{ $alloc->quiz_name }}</td>
                    <td>{{ $alloc->subject }}</td>
                    <td><span class="badge-primary">{{ $alloc->category }}</span></td>
                    <td>
                        @if($alloc->start_time && $alloc->end_time)
                            <div style="font-size: 0.8rem; color: var(--text-sub);">
                                {{ \Carbon\Carbon::parse($alloc->start_time)->format('d M Y H:i') }} <br> s/d <br> {{ \Carbon\Carbon::parse($alloc->end_time)->format('d M Y H:i') }}
                            </div>
                        @else
                            <span class="text-slate-400 italic" style="font-size: 0.8rem;">Selalu Aktif</span>
                        @endif
                    </td>
                    <td style="text-align:center;">{{ $alloc->attempts }} Kali</td>
                    <td>
                        <div style="display: flex; gap: 10px;">
                            <button onclick="openEditModal({{ $alloc->id }}, {{ $alloc->moodle_quiz_id }}, {{ $alloc->competency_id }}, '{{ $alloc->category }}', '{{ $alloc->start_time }}', '{{ $alloc->end_time }}', {{ $alloc->attempts }}, '{{ $alloc->school_id }}')" class="text-indigo-600 font-bold" style="border:none; background:none; cursor:pointer;">Edit</button>
                            <form action="{{ route('admin.quiz_deallocate', $alloc->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus alokasi ini?');" style="margin: 0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 font-bold" style="border:none; background:none; cursor:pointer;">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 2rem; color: var(--text-sub);">Belum ada kuis yang dialokasikan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah Alokasi Kuis -->
<div id="allocateModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); backdrop-filter: blur(4px); z-index: 100; align-items: center; justify-content: center; padding: 2rem;">
    <div class="modern-card" style="width: 100%; max-width: 600px; max-height: 90vh; overflow-y: auto;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h3 class="font-bold text-slate-800">Alokasikan Kuis Moodle</h3>
            <button type="button" onclick="document.getElementById('allocateModal').style.display='none'" style="border:none; background:none; cursor:pointer;">
                <i data-lucide="x" style="width: 20px; color: var(--text-sub);"></i>
            </button>
        </div>
        <form action="{{ route('admin.quiz_allocate') }}" method="POST">
            @csrf
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                <div>
                    <label class="text-xs font-bold text-slate-500 uppercase block mb-2">Pilih Kuis Moodle</label>
                    <select name="moodle_quiz_id" required style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main);">
                        <option value="">-- Pilih Kuis --</option>
                        @foreach($moodleQuizzes as $quiz)
                            <option value="{{ $quiz->id }}">{{ $quiz->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="text-xs font-bold text-slate-500 uppercase block mb-2">Mata Pelajaran</label>
                    <select name="competency_id" required style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main);">
                        <option value="">-- Pilih Mata Pelajaran --</option>
                        @foreach($competencies as $comp)
                            <option value="{{ $comp->id }}">{{ $comp->topic_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                <div>
                    <label class="text-xs font-bold text-slate-500 uppercase block mb-2">Kategori Kuis</label>
                    <select name="category" required style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main);">
                        <option value="TRYOUT">Try Out</option>
                        <option value="HARIAN">Latihan Harian</option>
                        <option value="EVALUASI">Evaluasi Ujian</option>
                    </select>
                </div>
                <div>
                    <label class="text-xs font-bold text-slate-500 uppercase block mb-2">Target Sekolah (Opsional)</label>
                    <select name="school_id" style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main);">
                        <option value="">-- Semua Sekolah --</option>
                        @foreach($schools as $school)
                            <option value="{{ $school->id }}">{{ $school->school_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem; margin-bottom: 2rem;">
                <div>
                    <label class="text-xs font-bold text-slate-500 uppercase block mb-2">Waktu Mulai</label>
                    <input type="datetime-local" name="start_time" style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main);">
                </div>
                <div>
                    <label class="text-xs font-bold text-slate-500 uppercase block mb-2">Waktu Selesai</label>
                    <input type="datetime-local" name="end_time" style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main);">
                </div>
                <div>
                    <label class="text-xs font-bold text-slate-500 uppercase block mb-2">Batas Pengerjaan</label>
                    <input type="number" name="attempts" min="1" value="1" style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main);">
                </div>
            </div>

            <button type="submit" class="btn-indigo" style="width: 100%; justify-content: center; padding: 1rem;">Simpan Alokasi</button>
        </form>
    </div>
</div>

<!-- Modal Edit Alokasi Kuis -->
<div id="editModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); backdrop-filter: blur(4px); z-index: 100; align-items: center; justify-content: center; padding: 2rem;">
    <div class="modern-card" style="width: 100%; max-width: 600px; max-height: 90vh; overflow-y: auto;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h3 class="font-bold text-slate-800">Edit Alokasi Kuis</h3>
            <button type="button" onclick="document.getElementById('editModal').style.display='none'" style="border:none; background:none; cursor:pointer;">
                <i data-lucide="x" style="width: 20px; color: var(--text-sub);"></i>
            </button>
        </div>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                <div>
                    <label class="text-xs font-bold text-slate-500 uppercase block mb-2">Pilih Kuis Moodle</label>
                    <select name="moodle_quiz_id" id="edit_moodle_quiz_id" required style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main);">
                        @foreach($moodleQuizzes as $quiz)
                            <option value="{{ $quiz->id }}">{{ $quiz->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="text-xs font-bold text-slate-500 uppercase block mb-2">Mata Pelajaran</label>
                    <select name="competency_id" id="edit_competency_id" required style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main);">
                        @foreach($competencies as $comp)
                            <option value="{{ $comp->id }}">{{ $comp->topic_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                <div>
                    <label class="text-xs font-bold text-slate-500 uppercase block mb-2">Kategori Kuis</label>
                    <select name="category" id="edit_category" required style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main);">
                        <option value="TRYOUT">Try Out</option>
                        <option value="HARIAN">Latihan Harian</option>
                        <option value="EVALUASI">Evaluasi Ujian</option>
                    </select>
                </div>
                <div>
                    <label class="text-xs font-bold text-slate-500 uppercase block mb-2">Target Sekolah (Opsional)</label>
                    <select name="school_id" id="edit_school_id" style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main);">
                        <option value="">-- Semua Sekolah --</option>
                        @foreach($schools as $school)
                            <option value="{{ $school->id }}">{{ $school->school_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem; margin-bottom: 2rem;">
                <div>
                    <label class="text-xs font-bold text-slate-500 uppercase block mb-2">Waktu Mulai</label>
                    <input type="datetime-local" name="start_time" id="edit_start_time" style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main);">
                </div>
                <div>
                    <label class="text-xs font-bold text-slate-500 uppercase block mb-2">Waktu Selesai</label>
                    <input type="datetime-local" name="end_time" id="edit_end_time" style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main);">
                </div>
                <div>
                    <label class="text-xs font-bold text-slate-500 uppercase block mb-2">Batas Pengerjaan</label>
                    <input type="number" name="attempts" id="edit_attempts" min="1" style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main);">
                </div>
            </div>

            <button type="submit" class="btn-indigo" style="width: 100%; justify-content: center; padding: 1rem;">Perbarui Alokasi</button>
        </form>
    </div>
</div>

<div style="margin-top: 2rem;">
    <a href="/admin/dashboard" class="text-indigo-600 font-bold text-sm" style="text-decoration:none;">&larr; Kembali ke Dashboard</a>
</div>

<script>
    function openEditModal(id, moodleQuizId, competencyId, category, startTime, endTime, attempts, schoolId) {
        document.getElementById('editForm').action = '/admin/active-quizzes/' + id;
        document.getElementById('edit_moodle_quiz_id').value = moodleQuizId;
        document.getElementById('edit_competency_id').value = competencyId;
        document.getElementById('edit_category').value = category;
        document.getElementById('edit_attempts').value = attempts;
        document.getElementById('edit_school_id').value = schoolId ? schoolId : '';
        
        // Handle datetime-local formatting (YYYY-MM-DDTHH:MM)
        if (startTime) {
            document.getElementById('edit_start_time').value = startTime.replace(' ', 'T').slice(0, 16);
        } else {
            document.getElementById('edit_start_time').value = '';
        }

        if (endTime) {
            document.getElementById('edit_end_time').value = endTime.replace(' ', 'T').slice(0, 16);
        } else {
            document.getElementById('edit_end_time').value = '';
        }

        document.getElementById('editModal').style.display = 'flex';
    }
</script>
@endsection
