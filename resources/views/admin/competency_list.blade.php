@extends('layouts.app')

@section('title', 'Daftar Mata Pelajaran - AI Learning')
@section('page_header', 'Manajemen Mata Pelajaran')
@section('page_subtitle', 'Tambah, edit, atau hapus kompetensi reguler dan micro-skill di seluruh sistem.')

@section('content')
<div style="margin-bottom: 2rem;">
    <a href="{{ route('admin.competency_architect') }}" class="text-indigo-600 font-bold text-sm" style="text-decoration:none;">&larr; Kembali ke Arsitek Kompetensi</a>
</div>

<div class="modern-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h3 class="text-slate-800 font-bold">Daftar Kompetensi Tersedia</h3>
        <button class="btn-indigo" onclick="document.getElementById('addCompModal').style.display='flex'">
            <i data-lucide="plus-circle" style="width: 18px;"></i> Tambah Pelajaran Baru
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
                    <th>Kode</th>
                    <th>Nama Mata Pelajaran</th>
                    <th>Tipe Paket</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Reguler Competencies -->
                @foreach($reguler as $comp)
                <tr>
                    <td class="text-xs font-bold text-slate-400">{{ $comp->topic_code }}</td>
                    <td class="font-bold">{{ $comp->topic_name }}</td>
                    <td><span class="badge-primary">REGULER</span></td>
                    <td style="text-align: center; display: flex; gap: 0.5rem; justify-content: center;">
                        <button class="btn-indigo" style="padding: 0.4rem; background: #f1f5f9; color: #475569;" 
                                onclick="openEditModal('{{ $comp->id }}', '{{ $comp->topic_code }}', '{{ $comp->topic_name }}', 'reguler')">
                            <i data-lucide="edit-2" style="width: 16px; height: 16px;"></i>
                        </button>
                        <form action="{{ route('admin.competency_delete', $comp->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pelajaran {{ $comp->topic_name }}?')">
                            @csrf
                            <input type="hidden" name="type" value="reguler">
                            <button class="btn-indigo" style="padding: 0.4rem; background: #fff1f2; color: #e11d48;">
                                <i data-lucide="trash-2" style="width: 16px; height: 16px;"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach

                <!-- Deep Competencies -->
                @foreach($deep as $comp)
                <tr>
                    <td class="text-xs font-bold text-slate-400">{{ $comp->topic_code }}</td>
                    <td class="font-bold">{{ $comp->topic_name }}</td>
                    <td><span class="badge-success" style="background: #ecfdf5; color: #059669;">MICRO-SKILL</span></td>
                    <td style="text-align: center; display: flex; gap: 0.5rem; justify-content: center;">
                        <button class="btn-indigo" style="padding: 0.4rem; background: #f1f5f9; color: #475569;"
                                onclick="openEditModal('{{ $comp->id }}', '{{ $comp->topic_code }}', '{{ $comp->topic_name }}', 'deep')">
                            <i data-lucide="edit-2" style="width: 16px; height: 16px;"></i>
                        </button>
                        <form action="{{ route('admin.competency_delete', $comp->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pelajaran {{ $comp->topic_name }}?')">
                            @csrf
                            <input type="hidden" name="type" value="deep">
                            <button class="btn-indigo" style="padding: 0.4rem; background: #fff1f2; color: #e11d48;">
                                <i data-lucide="trash-2" style="width: 16px; height: 16px;"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Add -->
<div id="addCompModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); backdrop-filter: blur(4px); z-index: 100; align-items: center; justify-content: center; padding: 2rem;">
    <div class="modern-card" style="width: 100%; max-width: 500px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h3 class="font-bold text-slate-800">Tambah Mata Pelajaran</h3>
            <button onclick="document.getElementById('addCompModal').style.display='none'" style="border:none; background:none; cursor:pointer;">
                <i data-lucide="x" style="width: 20px; color: var(--text-sub);"></i>
            </button>
        </div>
        <form action="{{ route('admin.competency_store') }}" method="POST">
            @csrf
            <div style="margin-bottom: 1rem;">
                <label class="text-xs font-bold text-slate-500 uppercase">Tipe Paket</label>
                <select name="type" required style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main);">
                    <option value="reguler">Paket Reguler (Mapel Utama)</option>
                    <option value="deep">Paket Micro-skill (Topik Spesifik)</option>
                </select>
            </div>
            <div style="margin-bottom: 1rem;">
                <label class="text-xs font-bold text-slate-500 uppercase">Kode Kompetensi</label>
                <input type="text" name="topic_code" placeholder="Contoh: MAT-01" required style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main);">
            </div>
            <div style="margin-bottom: 2rem;">
                <label class="text-xs font-bold text-slate-500 uppercase">Nama Pelajaran</label>
                <input type="text" name="topic_name" placeholder="Contoh: Matematika Dasar" required style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main);">
            </div>
            <button type="submit" class="btn-indigo" style="width: 100%; justify-content: center; padding: 1rem;">Daftarkan Pelajaran</button>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div id="editCompModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); backdrop-filter: blur(4px); z-index: 100; align-items: center; justify-content: center; padding: 2rem;">
    <div class="modern-card" style="width: 100%; max-width: 500px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h3 class="font-bold text-slate-800">Edit Data Pelajaran</h3>
            <button onclick="document.getElementById('editCompModal').style.display='none'" style="border:none; background:none; cursor:pointer;">
                <i data-lucide="x" style="width: 20px; color: var(--text-sub);"></i>
            </button>
        </div>
        <form id="editCompForm" method="POST">
            @csrf
            <input type="hidden" name="type" id="edit_type">
            <div style="margin-bottom: 1rem;">
                <label class="text-xs font-bold text-slate-500 uppercase">Kode Kompetensi</label>
                <input type="text" name="topic_code" id="edit_code" required style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main);">
            </div>
            <div style="margin-bottom: 2rem;">
                <label class="text-xs font-bold text-slate-500 uppercase">Nama Pelajaran</label>
                <input type="text" name="topic_name" id="edit_name" required style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main);">
            </div>
            <button type="submit" class="btn-indigo" style="width: 100%; justify-content: center; padding: 1rem;">Simpan Perubahan</button>
        </form>
    </div>
</div>

<script>
    function openEditModal(id, code, name, type) {
        document.getElementById('editCompForm').action = '/admin/competency-architect/update/' + id;
        document.getElementById('edit_type').value = type;
        document.getElementById('edit_code').value = code;
        document.getElementById('edit_name').value = name;
        document.getElementById('editCompModal').style.display = 'flex';
        lucide.createIcons();
    }

    // Pastikan ikon dimuat saat halaman pertama kali dibuka
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
@endsection
