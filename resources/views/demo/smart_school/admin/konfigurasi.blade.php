@extends('layouts.smart_school')

@section('title', 'Konfigurasi Sistem - Smart School')

@section('page_header', 'Konfigurasi Sistem')
@section('page_subtitle', 'Atur KKM, pengaturan umum, dan preferensi sistem')

@section('breadcrumb')
<span>Admin</span> / <span>Konfigurasi Sistem</span>
@endsection

@section('styles')
<style>
    .config-section { margin-bottom:2rem; }
    .config-section:last-child { margin-bottom:0; }
    .section-title { font-size:0.85rem; font-weight:700; color:var(--text-main); margin-bottom:1rem; display:flex; align-items:center; gap:0.5rem; }
    .section-title i { color:var(--primary); }
    .form-row { margin-bottom:1rem; }
    .form-row label { display:block; font-size:0.75rem; font-weight:600; color:var(--text-sub); margin-bottom:0.35rem; }
    .form-row input,.form-row select,.form-row textarea { width:100%; padding:0.6rem 1rem; border-radius:12px; border:1px solid var(--border); background:var(--bg-main); color:var(--text-main); font-size:0.8rem; outline:none; transition:all 0.2s; }
    .form-row input:focus,.form-row select:focus,.form-row textarea:focus { border-color:var(--primary); box-shadow:0 0 0 3px rgba(79,70,229,0.1); }
    .form-grid { display:grid; grid-template-columns:1fr 1fr; gap:1rem; }
    .toggle-wrap { display:flex; align-items:center; gap:0.75rem; padding:0.75rem 0; border-bottom:1px solid var(--border); }
    .toggle-wrap:last-child { border-bottom:none; }
    .toggle-switch { position:relative; width:44px; height:24px; flex-shrink:0; }
    .toggle-switch input { opacity:0; width:0; height:0; }
    .toggle-slider { position:absolute; cursor:pointer; inset:0; background:var(--border); border-radius:24px; transition:all 0.3s; }
    .toggle-slider:before { content:''; position:absolute; height:18px; width:18px; left:3px; bottom:3px; background:white; border-radius:50%; transition:all 0.3s; }
    .toggle-switch input:checked + .toggle-slider { background:var(--primary); }
    .toggle-switch input:checked + .toggle-slider:before { transform:translateX(20px); }
    @media(max-width:768px){ .form-grid { grid-template-columns:1fr; } }
</style>
@endsection

@section('content')
<div class="config-section">
    <div class="section-title"><i data-lucide="target" style="width:16px;"></i> Pengaturan KKM (Kriteria Ketuntasan Minimal)</div>
    <div class="modern-card" style="padding:0;overflow:hidden;">
        <div style="padding:0.25rem 0.5rem 0.5rem;">
            <div class="table-wrapper">
                <table>
                    <thead><tr><th style="width:50px;">No</th><th>Mata Pelajaran</th><th style="width:120px;">KKM</th><th style="width:100px;text-align:center;">Aksi</th></tr></thead>
                    <tbody>
                        @php
                            $mapels = [
                                ['Matematika', 70],
                                ['Bahasa Indonesia', 70],
                                ['Bahasa Inggris', 72],
                                ['IPA', 70],
                                ['IPS', 72],
                                ['PKN', 75],
                                ['Agama', 75],
                                ['SBK', 70],
                            ];
                        @endphp
                        @foreach($mapels as $i => $m)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td style="font-weight:600;">{{ $m[0] }}</td>
                            <td><span style="background:{{ $m[1] >= 75 ? '#05966915' : ($m[1] >= 72 ? '#d9770615' : '#4f46e515') }};color:{{ $m[1] >= 75 ? 'var(--success)' : ($m[1] >= 72 ? 'var(--warning)' : 'var(--primary)') }};padding:0.2rem 0.75rem;border-radius:9999px;font-size:0.8rem;font-weight:700;">{{ $m[1] }}</span></td>
                            <td style="text-align:center;">
                                <button class="action-btn edit" onclick="alert('Demo: Edit KKM {{ $m[0] }}')" style="display:inline-flex;align-items:center;gap:0.3rem;padding:0.4rem 0.75rem;border-radius:10px;border:none;font-size:0.75rem;font-weight:600;cursor:pointer;background:#4f46e515;color:var(--primary);transition:all 0.2s;">
                                    <i data-lucide="edit" style="width:12px;"></i> Edit
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="config-section">
    <div class="section-title"><i data-lucide="building-2" style="width:16px;"></i> Pengaturan Umum</div>
    <div class="modern-card">
        <form onsubmit="alert('Demo: Pengaturan disimpan');return false;">
            <div class="form-grid">
                <div class="form-row">
                    <label>Nama Sekolah</label>
                    <input type="text" value="SMA Negeri 1 Smart School" placeholder="Nama Sekolah">
                </div>
                <div class="form-row">
                    <label>Tahun Ajaran</label>
                    <input type="text" value="2025/2026" placeholder="Tahun Ajaran">
                </div>
            </div>
            <div class="form-grid" style="margin-top:0;">
                <div class="form-row">
                    <label>Akreditasi</label>
                    <select>
                        <option>A</option>
                        <option selected>B</option>
                        <option>C</option>
                        <option>Belum Terakreditasi</option>
                    </select>
                </div>
                <div class="form-row"></div>
            </div>
            <div class="form-row">
                <label>Alamat</label>
                <textarea rows="3" placeholder="Alamat lengkap sekolah">Jl. Pendidikan No. 123, Kelurahan Smart, Kecamatan Cerdas, Kota Pelajar 12345</textarea>
            </div>
            <div style="margin-top:1rem;">
                <button type="submit" class="btn-indigo"><i data-lucide="save" style="width:16px;"></i> Simpan Pengaturan</button>
            </div>
        </form>
    </div>
</div>

<div class="config-section">
    <div class="section-title"><i data-lucide="sliders-horizontal" style="width:16px;"></i> Pengaturan Lainnya</div>
    <div class="modern-card">
        <div class="toggle-wrap">
            <label class="toggle-switch"><input type="checkbox" checked><span class="toggle-slider"></span></label>
            <div>
                <div style="font-weight:600;font-size:0.85rem;">Kirim Notifikasi Otomatis</div>
                <div style="font-size:0.7rem;color:var(--text-sub);">Kirim pemberitahuan otomatis ke pengguna saat ada aktivitas penting</div>
            </div>
        </div>
        <div class="toggle-wrap">
            <label class="toggle-switch"><input type="checkbox" checked><span class="toggle-slider"></span></label>
            <div>
                <div style="font-weight:600;font-size:0.85rem;">Aktifkan Smart Remedial</div>
                <div style="font-size:0.7rem;color:var(--text-sub);">Siswa yang nilainya di bawah KKM otomatis masuk program remedial</div>
            </div>
        </div>
        <div class="toggle-wrap">
            <label class="toggle-switch"><input type="checkbox"><span class="toggle-slider"></span></label>
            <div>
                <div style="font-weight:600;font-size:0.85rem;">Aktifkan Cetak Rapor Massal</div>
                <div style="font-size:0.7rem;color:var(--text-sub);">Izinkan pencetakan rapor untuk seluruh siswa dalam satu kali proses</div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    try{ lucide.createIcons(); }catch(e){}
</script>
@endsection
