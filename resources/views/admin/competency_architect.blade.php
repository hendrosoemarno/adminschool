@extends('layouts.app')

@section('title', 'Arsitek Kompetensi - AI Learning')
@section('page_header', 'Arsitek Kompetensi')
@section('page_subtitle', 'Kelola target benchmark nasional dan pemetaan kategori soal Moodle.')

@section('content')
<!-- KKM Overview Stats -->
<div class="stat-group" style="margin-bottom: 2rem;">
    <div class="modern-card" onclick="window.location='{{ route('admin.competency_list') }}'" style="cursor: pointer; border-left: 4px solid var(--primary);">
        <div class="text-xs font-bold text-slate-500 uppercase mb-1">Jumlah Mata Pelajaran</div>
        <div class="text-3xl font-bold text-slate-800">{{ $regulerCompetencies->count() }}</div>
        <p class="text-xs text-indigo-600 mt-2 font-bold">Klik untuk kelola & tambah mapel</p>
    </div>
    <div class="modern-card" onclick="window.location='{{ route('admin.competency_list') }}'" style="cursor: pointer; border-left: 4px solid var(--success);">
        <div class="text-xs font-bold text-slate-500 uppercase mb-1">Kompetensi Micro-skill</div>
        <div class="text-3xl font-bold text-slate-800">{{ $deepCompetencies->count() }}</div>
        <p class="text-xs text-emerald-600 mt-2 font-bold">Klik untuk kelola topik spesifik</p>
    </div>
</div>

<div style="display: flex; flex-direction: column; gap: 2.5rem; margin-bottom: 2rem;">
    <!-- Benchmark Settings Card -->
    <div class="modern-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <div>
                <h3 class="text-slate-800 font-bold">Set Target Score (Benchmark)</h3>
                <div style="margin-top: 0.5rem; display: flex; align-items: center; gap: 0.75rem;">
                    <label class="text-xs font-bold text-slate-500 uppercase">Pilih Sekolah:</label>
                    <select name="school_id" style="padding: 0.4rem 1rem; border-radius: 10px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main); font-size: 13px; min-width: 200px;">
                        @foreach($schools as $school)
                            <option value="{{ $school->id }}">{{ $school->school_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button class="btn-indigo">
                <i data-lucide="save" style="width: 16px;"></i> Simpan Target Sekolah
            </button>
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
                    @forelse($regulerCompetencies as $comp)
                    <tr>
                        <td class="font-bold">{{ $comp->topic_name }}</td>
                        <td style="text-align: center;">75.0</td>
                        <td style="text-align: center;">72.5</td>
                        <td style="text-align: center;">71.0</td>
                        <td style="text-align: center; background: rgba(79, 70, 229, 0.05);">
                            <input type="number" value="70.0" style="width: 60px; padding: 0.2rem; border-radius: 6px; border: 1px solid var(--border); text-align: center;">
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" style="text-align: center; padding: 2rem;">Belum ada Mapel.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Smart Mapping Wizard -->
    <div class="modern-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h3 class="text-slate-800 font-bold">Mulai Analisis & Pemetaan Kategori</h3>
            <form action="{{ route('admin.competency_auto_map') }}" method="POST" style="display: flex; gap: 1rem;">
                @csrf
                <select name="moodle_category_id" required style="padding: 0.4rem 1rem; border-radius: 10px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main); min-width: 250px; max-width: 400px;">
                    <option value="">-- Pilih Kategori Utama Bank Soal Moodle --</option>
                    @foreach($moodleCategories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn-indigo">Jalankan Parser Kategori Anak</button>
            </form>
        </div>
        
        <div class="glass" style="padding: 1rem; border-radius: 15px; margin-bottom: 2rem; border-left: 4px solid var(--primary);">
            <p class="text-xs font-bold text-indigo-600 mb-1">Standard Naming Format:</p>
            <code>[KODE_MAPEL]-[KODE_JENIS]-[NOMOR]-[LABEL]</code>
        </div>

        <div class="table-wrapper">
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
                        <td style="text-align: center;">Course #{{ $map->course_id }}</td>
                        <td><span class="badge-success">MAPPED</span></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 2rem;">Belum ada hasil pemetaan otomatis untuk course manapun. Silakan jalankan Auto-Mapping di atas.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<form action="{{ route('admin.update_kkm') }}" method="POST" class="modern-card">
    @csrf
    <h3 class="text-slate-800 font-bold mb-6">Pengaturan KKM Sekolah</h3>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Mata Pelajaran</th>
                    <th style="width: 150px; text-align: center;">Nilai KKM</th>
                </tr>
            </thead>
            <tbody>
                @forelse($regulerCompetencies as $comp)
                <tr>
                    <td class="font-bold">{{ $comp->topic_name }}</td>
                    <td style="text-align: center;"><input type="number" value="75" style="width: 80px; padding: 0.4rem; border-radius: 8px; border: 1px solid var(--border); text-align: center;"></td>
                </tr>
                @empty
                <tr><td colspan="2" style="text-align: center; padding: 2rem;">Belum ada Mapel.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</form>
@endsection
