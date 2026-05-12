@extends('layouts.app')

@section('title', 'Arsitek Kompetensi - AI Learning')
@section('page_header', 'Arsitek Kompetensi')
@section('page_subtitle', 'Kelola target benchmark, KKM, dan pemetaan kategori soal Moodle.')

@section('content')
<!-- Stats -->
<div class="stat-group" style="margin-bottom: 2rem;">
    <div class="modern-card" onclick="window.location='{{ route('admin.competency_list') }}'" style="cursor: pointer; border-left: 4px solid var(--primary);">
        <div class="text-xs font-bold text-slate-500 uppercase mb-1">Jumlah Mata Pelajaran</div>
        <div class="text-3xl font-bold text-slate-800">{{ $regulerCompetencies->where('type','pelajaran')->count() }}</div>
        <p class="text-xs text-indigo-600 mt-2 font-bold">Klik untuk kelola & tambah mapel</p>
    </div>
    <div class="modern-card" onclick="window.location='{{ route('admin.competency_list') }}'" style="cursor: pointer; border-left: 4px solid var(--success);">
        <div class="text-xs font-bold text-slate-500 uppercase mb-1">Jumlah Kompetensi</div>
        <div class="text-3xl font-bold text-slate-800">{{ $regulerCompetencies->where('type','topik')->count() }}</div>
        <p class="text-xs text-emerald-600 mt-2 font-bold">Klik untuk kelola</p>
    </div>
</div>

<!-- Pilih Sekolah (shared filter) -->
<div class="modern-card" style="margin-bottom: 2rem; padding: 1rem 2rem;">
    <form method="GET" action="{{ route('admin.competency_architect') }}" style="display: flex; align-items: center; gap: 1.5rem;">
        <label class="text-xs font-bold text-slate-500 uppercase">Pilih Sekolah:</label>
        <select name="school_id" onchange="this.form.submit()" style="padding: 0.5rem 1.5rem; border-radius: 10px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main); font-size: 13px; min-width: 250px;">
            @foreach($schools as $school)
                <option value="{{ $school->id }}" {{ $school->id == $selectedSchoolId ? 'selected' : '' }}>{{ $school->school_name }} ({{ strtoupper($school->jenjang ?? '-') }})</option>
            @endforeach
        </select>
        @if($selectedSchool && $selectedSchool->jenjang)
            <span class="badge-primary" style="font-size:11px;">Menampilkan mapel {{ strtoupper($selectedSchool->jenjang) }}</span>
        @endif
    </form>
</div>

<div style="display: flex; flex-direction: column; gap: 2.5rem; margin-bottom: 2rem;">
    <!-- Set Target Score (Benchmark) -->
    <form method="POST" action="{{ route('admin.update_benchmark') }}" class="modern-card">
        @csrf
        <input type="hidden" name="school_id" value="{{ $selectedSchoolId }}">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h3 class="text-slate-800 font-bold">Set Target Score (Benchmark)</h3>
            <button type="submit" class="btn-indigo"><i data-lucide="save" style="width: 16px;"></i> Simpan Target</button>
        </div>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Mata Pelajaran</th>
                        <th style="text-align: center;">Nasional</th>
                        <th style="text-align: center;">Provinsi</th>
                        <th style="text-align: center;">Kota</th>
                        <th style="text-align: center; background: rgba(79, 70, 229, 0.05);">Sekolah</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($subjects as $comp)
                    @php
                        $bKey = $comp->id . '_' . $selectedSchoolId;
                        $b = $benchmarkSettings[$bKey] ?? null;
                    @endphp
                    <tr>
                        <td class="font-bold">{{ $comp->topic_name }}</td>
                        <td style="text-align: center;"><input type="number" name="benchmark[{{ $comp->id }}][nasional]" value="{{ $b->target_national ?? 75 }}" style="width:60px;padding:0.2rem;border-radius:6px;border:1px solid var(--border);text-align:center;"></td>
                        <td style="text-align: center;"><input type="number" name="benchmark[{{ $comp->id }}][provinsi]" value="{{ $b->target_province ?? 72 }}" style="width:60px;padding:0.2rem;border-radius:6px;border:1px solid var(--border);text-align:center;"></td>
                        <td style="text-align: center;"><input type="number" name="benchmark[{{ $comp->id }}][kota]" value="{{ $b->target_city ?? 70 }}" style="width:60px;padding:0.2rem;border-radius:6px;border:1px solid var(--border);text-align:center;"></td>
                        <td style="text-align: center; background: rgba(79, 70, 229, 0.05);"><input type="number" name="benchmark[{{ $comp->id }}][sekolah]" value="{{ $b->target_school ?? 70 }}" style="width:60px;padding:0.2rem;border-radius:6px;border:1px solid var(--border);text-align:center;"></td>
                    </tr>
                    @empty
                    <tr><td colspan="5" style="text-align:center;padding:2rem;">Tidak ada mapel untuk jenjang ini.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </form>

    <!-- KKM Settings -->
    <form action="{{ route('admin.update_kkm') }}" method="POST" class="modern-card">
        @csrf
        <input type="hidden" name="school_id" value="{{ $selectedSchoolId }}">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h3 class="text-slate-800 font-bold">Pengaturan KKM Sekolah</h3>
            <button type="submit" class="btn-indigo"><i data-lucide="save" style="width: 16px;"></i> Simpan KKM</button>
        </div>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Mata Pelajaran</th>
                        <th style="width:150px;text-align:center;">Nilai KKM</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($subjects as $comp)
                    @php
                        $kKey = $comp->id . '_' . $selectedSchoolId;
                        $k = $kkmSettings[$kKey] ?? null;
                    @endphp
                    <tr>
                        <td class="font-bold">{{ $comp->topic_name }}</td>
                        <td style="text-align:center;"><input type="number" name="kkm[{{ $comp->id }}]" value="{{ $k->min_score ?? 70 }}" style="width:80px;padding:0.4rem;border-radius:8px;border:1px solid var(--border);text-align:center;"></td>
                    </tr>
                    @empty
                    <tr><td colspan="2" style="text-align:center;padding:2rem;">Tidak ada mapel untuk jenjang ini.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </form>

    <!-- Auto Parser Card -->
    <div class="modern-card" style="border-left: 4px solid #8b5cf6;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h3 class="text-slate-800 font-bold">Parser Kategori Soal</h3>
            <form action="{{ route('admin.competency_auto_map') }}" method="POST" style="display: flex; gap: 0.75rem; align-items:center;">
                @csrf
                <select name="moodle_category_id" required style="padding:0.4rem 1rem;border-radius:10px;border:1px solid var(--border);background:var(--bg-card);color:var(--text-main);min-width:250px;">
                    <option value="">-- Pilih Kategori Utama --</option>
                    @foreach($moodleCategories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn-indigo" style="padding:0.5rem 1rem;font-size:13px;">Jalankan</button>
            </form>
        </div>
        <div class="glass" style="padding:0.75rem 1rem;border-radius:10px;margin-top:1rem;">
            <code style="font-size:11px;">[KODE_MAPEL]-[KODE_JENIS]-[NOMOR]-[LABEL]</code>
        </div>
    </div>

    <!-- Mulai Analisis & Pemetaan Kategori -->
    <div class="modern-card" style="cursor:pointer;" onclick="document.getElementById('mappingTable').style.display = document.getElementById('mappingTable').style.display === 'none' ? 'block' : 'none'">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h3 class="text-slate-800 font-bold">Mulai Analisis & Pemetaan Kategori</h3>
                <p class="text-xs text-slate-500 mt-1">Klik untuk melihat detail pemetaan</p>
            </div>
            <div style="text-align:right;">
                <div class="text-3xl font-bold text-slate-800">{{ $mappingsData->count() }}</div>
                <div class="text-xs font-bold text-slate-500 uppercase">Kompetensi Terpetakan</div>
            </div>
        </div>

        <div id="mappingTable" class="table-wrapper" style="margin-top:1.5rem; {{ $mappingsData->isEmpty() ? 'display:none;' : '' }}">
            <table>
                <thead>
                    <tr>
                        <th>Moodle Category (Bank Soal)</th>
                        <th>Mapped Competency (Topik AI)</th>
                        <th>Course ID</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mappingsData as $map)
                    <tr>
                        <td>{{ $map->moodle_category_name }}</td>
                        <td class="font-bold text-indigo-600">{{ $map->topic_name }}</td>
                        <td style="text-align:center;">Course #{{ $map->course_id }}</td>
                        <td><span class="badge-success">MAPPED</span></td>
                    </tr>
                    @empty
                    <tr><td colspan="4" style="text-align:center;padding:2rem;">Belum ada hasil pemetaan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection