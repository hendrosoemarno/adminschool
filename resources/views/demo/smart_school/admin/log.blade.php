@extends('layouts.smart_school')

@section('title', 'Log Sistem - Smart School')

@section('page_header', 'Log Sistem')
@section('page_subtitle', 'Riwayat aktivitas dan perubahan dalam sistem')

@section('breadcrumb')
<span>Admin</span> / <span>Log Sistem</span>
@endsection

@section('styles')
<style>
    .filter-bar { display:flex; flex-wrap:wrap; gap:0.75rem; align-items:center; margin-bottom:1.25rem; }
    .filter-bar input,.filter-bar select { padding:0.55rem 1rem; border-radius:12px; border:1px solid var(--border); background:var(--bg-main); color:var(--text-main); font-size:0.8rem; outline:none; transition:all 0.2s; }
    .filter-bar input:focus,.filter-bar select:focus { border-color:var(--primary); box-shadow:0 0 0 3px rgba(79,70,229,0.1); }
    .pagination { display:flex; align-items:center; justify-content:center; gap:0.5rem; margin-top:1.25rem; font-size:0.8rem; }
    .pagination span { padding:0.4rem 0.75rem; border-radius:10px; background:var(--bg-main); color:var(--text-sub); border:1px solid var(--border); }
    .pagination span.active { background:var(--primary); color:white; border-color:var(--primary); }
    .pagination span.dots { background:none; border:none; }
    .log-activity { font-size:0.75rem; padding:0.15rem 0.5rem; border-radius:9999px; font-weight:600; display:inline-block; }
    .log-ip { font-family:'Courier New',monospace; font-size:0.75rem; color:var(--text-sub); background:var(--bg-main); padding:0.15rem 0.5rem; border-radius:6px; }
    .pagination span[onclick]:hover { border-color:var(--primary); color:var(--primary); cursor:pointer; }
</style>
@endsection

@section('content')
<div class="modern-card" style="padding:0;overflow:hidden;">
    <div style="padding:1.5rem 1.5rem 0.75rem;">
        <div class="filter-bar" style="margin-bottom:0;">
            <input type="date" value="2026-05-01" style="width:150px;">
            <span style="color:var(--text-sub);font-size:0.8rem;">s.d.</span>
            <input type="date" value="2026-05-27" style="width:150px;">
            <select style="width:160px;">
                <option>Semua Aktivitas</option>
                <option>Login</option>
                <option>Input</option>
                <option>Export</option>
                <option>Hapus</option>
            </select>
            <button class="btn-indigo" onclick="alert('Demo: Filter log diterapkan')" style="padding:0.55rem 1.25rem;"><i data-lucide="search" style="width:14px;"></i> Cari</button>
            <button class="btn-outline-sm" onclick="alert('Demo: Export log sistem')"><i data-lucide="download" style="width:14px;"></i> Export</button>
        </div>
    </div>
    <div class="table-wrapper" style="padding:0 0.5rem 0.5rem;">
        <table>
            <thead><tr><th style="width:50px;">No</th><th style="width:160px;">Tanggal & Waktu</th><th>Pengguna</th><th>Aktivitas</th><th>Detail</th><th style="width:130px;">IP Address</th></tr></thead>
            <tbody>
                @php
                    $logs = [
                        ['2026-05-27 08:15:22','Ahmad Fauzi','Login','Berhasil login ke sistem','192.168.1.10'],
                        ['2026-05-27 08:10:15','Siti Rahmawati','Login','Berhasil login ke sistem','192.168.1.11'],
                        ['2026-05-27 07:45:00','Admin System','Input','Menambahkan data siswa baru (3 record)','192.168.1.5'],
                        ['2026-05-26 16:30:12','Dr. H. Supriyono, M.Pd.','Export','Mengexport rapor kelas X-A','192.168.1.20'],
                        ['2026-05-26 14:22:08','Budi Hartono, S.Kom.','Input','Menginput nilai asesmen Matematika','192.168.1.12'],
                        ['2026-05-26 11:05:33','Admin System','Hapus','Menghapus 2 data pengguna nonaktif','192.168.1.5'],
                        ['2026-05-26 09:18:45','Dewi Sartika, S.Pd.','Login','Berhasil login ke sistem','192.168.1.14'],
                        ['2026-05-25 15:44:10','Fitri Handayani','Export','Mengexport laporan kehadiran bulanan','192.168.1.8'],
                        ['2026-05-25 13:30:00','Rina Marlina, S.Pd.','Login','Gagal login (3x percobaan)','192.168.1.30'],
                        ['2026-05-25 10:12:55','Admin System','Input','Mengupdate KKM mata pelajaran (4 mapel)','192.168.1.5'],
                        ['2026-05-24 20:05:30','Eko Prasetyo','Login','Berhasil login ke sistem','192.168.1.15'],
                        ['2026-05-24 19:00:00','Admin System','Hapus','Membersihkan log sistem (data >30 hari)','192.168.1.5'],
                    ];
                @endphp
                @foreach($logs as $i => $log)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td style="white-space:nowrap;font-weight:600;">{{ $log[0] }}</td>
                    <td>{{ $log[1] }}</td>
                    <td>
                        @php
                            $act = $log[2];
                            $actColor = match($act) {
                                'Login' => 'var(--primary)',
                                'Input' => 'var(--success)',
                                'Export' => 'var(--warning)',
                                'Hapus' => 'var(--danger)',
                                default => 'var(--text-sub)',
                            };
                            $actBg = match($act) {
                                'Login' => '#4f46e515',
                                'Input' => '#05966915',
                                'Export' => '#d9770615',
                                'Hapus' => '#dc262615',
                                default => '#64748b15',
                            };
                        @endphp
                        <span class="log-activity" style="background:{{ $actBg }};color:{{ $actColor }};">{{ $act }}</span>
                    </td>
                    <td style="color:var(--text-sub);max-width:280px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $log[3] }}</td>
                    <td><span class="log-ip">{{ $log[4] }}</span></td>
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
    <span style="cursor:pointer;" onclick="alert('Demo: Halaman 4')">4</span>
    <span class="dots">...</span>
    <span style="cursor:pointer;" onclick="alert('Demo: Halaman selanjutnya')"><i data-lucide="chevron-right" style="width:14px;"></i></span>
    <span style="color:var(--text-sub);font-size:0.7rem;margin-left:0.75rem;">Hal 1 dari 4</span>
</div>
@endsection

@section('scripts')
<script>
    try{ lucide.createIcons(); }catch(e){}
</script>
@endsection
