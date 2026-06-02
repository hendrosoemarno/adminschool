@extends('layouts.smart_school')

@section('title', 'Manajemen Pengguna - Smart School')

@section('page_header', 'Manajemen Pengguna')
@section('page_subtitle', 'Kelola seluruh akun pengguna sistem')

@section('breadcrumb')
<span>Admin</span> / <span>Manajemen Pengguna</span>
@endsection

@section('styles')
<style>
    .user-stat { display:grid; grid-template-columns:repeat(4,1fr); gap:1rem; margin-bottom:1.5rem; }
    .stat-item { text-align:center; padding:1rem; border-radius:16px; background:var(--bg-main); }
    .stat-item h4 { font-size:1.5rem; font-weight:800; margin-bottom:0.25rem; }
    .stat-item p { font-size:0.7rem; color:var(--text-sub); font-weight:600; text-transform:uppercase; }
    .filter-bar { display:flex; flex-wrap:wrap; gap:0.75rem; align-items:center; margin-bottom:1.25rem; }
    .filter-bar input,.filter-bar select { padding:0.55rem 1rem; border-radius:12px; border:1px solid var(--border); background:var(--bg-main); color:var(--text-main); font-size:0.8rem; outline:none; transition:all 0.2s; }
    .filter-bar input:focus,.filter-bar select:focus { border-color:var(--primary); box-shadow:0 0 0 3px rgba(79,70,229,0.1); }
    .pagination { display:flex; align-items:center; justify-content:center; gap:0.5rem; margin-top:1.25rem; font-size:0.8rem; }
    .pagination span { padding:0.4rem 0.75rem; border-radius:10px; background:var(--bg-main); color:var(--text-sub); border:1px solid var(--border); }
    .pagination span.active { background:var(--primary); color:white; border-color:var(--primary); }
    .pagination span.dots { background:none; border:none; }
    .action-btn { display:inline-flex; align-items:center; gap:0.3rem; padding:0.4rem 0.75rem; border-radius:10px; border:none; font-size:0.75rem; font-weight:600; cursor:pointer; transition:all 0.2s; }
    .action-btn.edit { background:#4f46e515; color:var(--primary); }
    .action-btn.edit:hover { background:var(--primary); color:white; }
    .action-btn.danger { background:#dc262615; color:var(--danger); }
    .action-btn.danger:hover { background:var(--danger); color:white; }
    @media(max-width:768px){ .user-stat { grid-template-columns:repeat(2,1fr); } }
</style>
@endsection

@section('content')
<div class="user-stat">
    <div class="stat-item"><h4 style="color:var(--primary);">24</h4><p>Total Pengguna</p></div>
    <div class="stat-item"><h4 style="color:var(--success);">18</h4><p>Aktif</p></div>
    <div class="stat-item"><h4 style="color:var(--warning);">4</h4><p>Nonaktif</p></div>
    <div class="stat-item"><h4 style="color:var(--text-sub);">2</h4><p>Online Sekarang</p></div>
</div>

<div class="modern-card" style="padding:0;overflow:hidden;">
    <div style="display:flex;justify-content:space-between;align-items:center;padding:1.5rem 1.5rem 0.75rem;flex-wrap:wrap;gap:0.75rem;">
        <div class="filter-bar" style="margin-bottom:0;">
            <select style="width:140px;"><option>Semua Role</option><option>Guru</option><option>Kepala Sekolah</option><option>Admin</option></select>
            <input type="text" placeholder="Cari pengguna..." style="width:220px;">
            <button class="btn-outline-sm" onclick="alert('Demo: Filter diterapkan')"><i data-lucide="search" style="width:14px;"></i> Cari</button>
        </div>
        <button class="btn-indigo" onclick="alert('Demo: Tambah Pengguna Baru')"><i data-lucide="user-plus" style="width:16px;"></i> Tambah Pengguna Baru</button>
    </div>
    <div class="table-wrapper" style="padding:0 0.5rem 0.5rem;">
        <table>
            <thead><tr><th style="width:50px;">No</th><th>Nama</th><th>Username</th><th>Email</th><th>Role</th><th>Status</th><th style="text-align:center;">Aksi</th></tr></thead>
            <tbody>
                @php
                    $users = [
                        ['Ahmad Fauzi','ahmadf','ahmad@sekolah.sch.id','Guru','Aktif'],
                        ['Siti Rahmawati','siti_r','siti@sekolah.sch.id','Guru','Aktif'],
                        ['Dr. H. Supriyono, M.Pd.','supriyono','supriyono@sekolah.sch.id','Kepala Sekolah','Aktif'],
                        ['Rina Marlina, S.Pd.','rina_m','rina@sekolah.sch.id','Guru','Nonaktif'],
                        ['Admin System','admin','admin@sekolah.sch.id','Admin','Aktif'],
                        ['Budi Hartono, S.Kom.','budi_h','budi@sekolah.sch.id','Guru','Aktif'],
                        ['Dewi Sartika, S.Pd.','dewi_s','dewi@sekolah.sch.id','Guru','Aktif'],
                        ['Eko Prasetyo','eko_p','eko@sekolah.sch.id','Guru','Nonaktif'],
                        ['Fitri Handayani','fitri_h','fitri@sekolah.sch.id','Admin','Aktif'],
                        ['Dr. Lilik Nurlaila','lilik_n','lilik@sekolah.sch.id','Kepala Sekolah','Nonaktif'],
                    ];
                @endphp
                @foreach($users as $i => $u)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td style="font-weight:600;">{{ $u[0] }}</td>
                    <td style="color:var(--text-sub);">{{ $u[1] }}</td>
                    <td style="color:var(--text-sub);">{{ $u[2] }}</td>
                    <td><span class="badge-{{ $u[3] === 'Admin' ? 'yellow' : ($u[3] === 'Kepala Sekolah' ? 'green' : '') }}" style="background:{{ $u[3] === 'Admin' ? '#d9770615' : ($u[3] === 'Kepala Sekolah' ? '#05966915' : '#4f46e515') }};color:{{ $u[3] === 'Admin' ? 'var(--warning)' : ($u[3] === 'Kepala Sekolah' ? 'var(--success)' : 'var(--primary)') }};padding:0.2rem 0.6rem;border-radius:9999px;font-size:0.7rem;font-weight:700;">{{ $u[3] }}</span></td>
                    <td><span class="badge-{{ $u[4] === 'Aktif' ? 'green' : 'red' }}">{{ $u[4] }}</span></td>
                    <td style="text-align:center;">
                        <button class="action-btn edit" onclick="alert('Demo: Edit pengguna {{ $u[0] }}')"><i data-lucide="edit" style="width:12px;"></i> Edit</button>
                        <button class="action-btn danger" onclick="alert('Demo: Hapus pengguna {{ $u[0] }}')"><i data-lucide="trash-2" style="width:12px;"></i> Hapus</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="pagination">
    <span style="cursor:pointer;" onclick="alert('Demo: Halaman sebelumnya')"><i data-lucide="chevron-left" style="width:14px;"></i></span>
    <span class="active">1</span>
    <span style="cursor:pointer;" onclick="alert('Demo: Halaman 2')">2</span>
    <span style="cursor:pointer;" onclick="alert('Demo: Halaman 3')">3</span>
    <span class="dots">...</span>
    <span style="cursor:pointer;" onclick="alert('Demo: Halaman selanjutnya')"><i data-lucide="chevron-right" style="width:14px;"></i></span>
    <span style="color:var(--text-sub);font-size:0.7rem;margin-left:0.75rem;">Hal 1 dari 3</span>
</div>
@endsection

@section('scripts')
<script>
    try{ lucide.createIcons(); }catch(e){}
</script>
@endsection
