@extends('layouts.app')

@section('title', 'Onboarding Sekolah - AI Learning')
@section('page_header', 'Registrasi & Pengaturan Sekolah')
@section('page_subtitle', 'Langkah awal untuk menghubungkan ekosistem Moodle sekolah ke platform analitik AI.')

@section('content')
<div style="display: grid; grid-template-columns: 1fr 1.5fr; gap: 2rem;">
    
    <!-- Registration Form -->
    <div class="modern-card">
        <h3 class="text-slate-800 font-bold mb-6">Daftarkan Sekolah Baru</h3>
        
        @if(session('success'))
            <div class="badge-success" style="margin-bottom: 1.5rem; padding: 1rem; border-radius: 12px; width: 100%; text-align: center;">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.school_store') }}" method="POST">
            @csrf
            <div style="margin-bottom: 1.5rem;">
                <label class="text-xs font-bold text-slate-500 uppercase block mb-2">NPSN Sekolah</label>
                <input type="text" name="npsn" placeholder="Contoh: 20123456" style="width: 100%; padding: 0.75rem 1rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main);" required>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label class="text-xs font-bold text-slate-500 uppercase block mb-2">Nama Sekolah</label>
                <input type="text" name="school_name" placeholder="Contoh: SMA Negeri 1 Jakarta" style="width: 100%; padding: 0.75rem 1rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main);" required>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label class="text-xs font-bold text-slate-500 uppercase block mb-2">Jenjang</label>
                <select name="jenjang" style="width: 100%; padding: 0.75rem 1rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main);" required>
                    <option value="">-- Pilih Jenjang --</option>
                    <option value="sd">SD</option>
                    <option value="smp">SMP</option>
                    <option value="sma">SMA</option>
                </select>
            </div>

            <div style="margin-bottom: 1.5rem;">
                <label class="text-xs font-bold text-slate-500 uppercase block mb-2">Alamat / Lokasi</label>
                <textarea name="address" rows="3" placeholder="Alamat lengkap sekolah..." style="width: 100%; padding: 0.75rem 1rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main);" required></textarea>
            </div>

            <button type="submit" class="btn-indigo" style="width: 100%; justify-content: center; padding: 1rem;">
                <i data-lucide="plus-circle" style="width: 18px;"></i> Daftarkan Sekolah
            </button>
        </form>
    </div>

    <!-- Existing Schools List -->
    <div class="modern-card">
        <h3 class="text-slate-800 font-bold mb-6">Sekolah Terdaftar</h3>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>NPSN</th>
                        <th>Nama Sekolah</th>
                        <th>Jenjang</th>
                        <th>Alamat</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($schools as $school)
                    <tr>
                        <td class="text-xs font-bold text-slate-400">{{ $school->npsn }}</td>
                        <td class="font-bold">{{ $school->school_name }}</td>
                        <td><span class="badge-{{ $school->jenjang == 'sd' ? 'primary' : ($school->jenjang == 'sma' ? 'success' : 'warning') }}">{{ strtoupper($school->jenjang ?? '-') }}</span></td>
                        <td class="text-xs text-slate-500">{{ $school->address }}</td>
                        <td style="text-align: center; display: flex; gap: 0.5rem; justify-content: center;">
                            <button class="btn-indigo" style="padding: 0.4rem; background: #f1f5f9; color: #475569;" 
                                    onclick="openEditSchoolModal('{{ $school->id }}', '{{ $school->npsn }}', '{{ $school->school_name }}', '{{ $school->address }}', '{{ $school->jenjang ?? '' }}')">
                                <i data-lucide="edit-2" style="width: 14px;"></i>
                            </button>
                            <form action="{{ route('admin.school_delete', $school->id) }}" method="POST" onsubmit="return confirm('Hapus sekolah {{ $school->school_name }}? Data kelas dan guru di dalamnya akan ikut terhapus.')">
                                @csrf
                                <button class="btn-indigo" style="padding: 0.4rem; background: #fff1f2; color: #e11d48;">
                                    <i data-lucide="trash-2" style="width: 14px;"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 3rem; color: #94a3b8;">
                            Belum ada sekolah terdaftar. Silakan gunakan form di samping.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Edit School -->
<div id="editSchoolModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); backdrop-filter: blur(4px); z-index: 100; align-items: center; justify-content: center; padding: 2rem;">
    <div class="modern-card" style="width: 100%; max-width: 500px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h3 class="font-bold text-slate-800">Edit Data Sekolah</h3>
            <button onclick="document.getElementById('editSchoolModal').style.display='none'" style="border:none; background:none; cursor:pointer;">
                <i data-lucide="x" style="width: 20px; color: var(--text-sub);"></i>
            </button>
        </div>
        <form id="editSchoolForm" method="POST">
            @csrf
            <div style="margin-bottom: 1.5rem;">
                <label class="text-xs font-bold text-slate-500 uppercase block mb-2">NPSN Sekolah</label>
                <input type="text" name="npsn" id="edit_npsn" required style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main);">
            </div>
            <div style="margin-bottom: 1.5rem;">
                <label class="text-xs font-bold text-slate-500 uppercase block mb-2">Nama Sekolah</label>
                <input type="text" name="school_name" id="edit_school_name" required style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main);">
            </div>
            <div style="margin-bottom: 1.5rem;">
                <label class="text-xs font-bold text-slate-500 uppercase block mb-2">Jenjang</label>
                <select name="jenjang" id="edit_jenjang" style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main);">
                    <option value="">-- Pilih --</option>
                    <option value="sd">SD</option>
                    <option value="smp">SMP</option>
                    <option value="sma">SMA</option>
                </select>
            </div>
            <div style="margin-bottom: 2rem;">
                <label class="text-xs font-bold text-slate-500 uppercase block mb-2">Alamat / Lokasi</label>
                <textarea name="address" id="edit_address" rows="3" required style="width: 100%; padding: 0.75rem; border-radius: 12px; border: 1px solid var(--border); background: var(--bg-card); color: var(--text-main);"></textarea>
            </div>
            <button type="submit" class="btn-indigo" style="width: 100%; justify-content: center; padding: 1rem;">Simpan Perubahan</button>
        </form>
    </div>
</div>

<script>
    function openEditSchoolModal(id, npsn, name, address, jenjang) {
        document.getElementById('editSchoolForm').action = '/admin/school-update/' + id;
        document.getElementById('edit_npsn').value = npsn;
        document.getElementById('edit_school_name').value = name;
        document.getElementById('edit_address').value = address;
        document.getElementById('edit_jenjang').value = jenjang || '';
        document.getElementById('editSchoolModal').style.display = 'flex';
        lucide.createIcons();
    }
</script>

<div class="modern-card" style="margin-top: 2rem; border-left: 4px solid var(--primary);">
    <div style="display: flex; gap: 1.5rem; align-items: center;">
        <div style="width: 60px; height: 60px; background: rgba(79, 70, 229, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--primary);">
            <i data-lucide="info" style="width: 30px; height: 30px;"></i>
        </div>
        <div>
            <h4 class="font-bold text-slate-800">Penting: Langkah Selanjutnya</h4>
            <p class="text-sm text-slate-500">Setelah mendaftarkan sekolah, Anda harus membuat <strong>Kelas</strong> dan menghubungkannya dengan user Moodle yang bertindak sebagai <strong>Wali Kelas</strong>.</p>
        </div>
    </div>
</div>
@endsection
