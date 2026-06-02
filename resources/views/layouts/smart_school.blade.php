<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Smart School')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary: #4f46e5;
            --bg-main: #f8fafc;
            --bg-card: #ffffff;
            --text-main: #1e293b;
            --text-sub: #64748b;
            --border: #f1f5f9;
            --glass-bg: rgba(255, 255, 255, 0.75);
            --glass-border: rgba(255, 255, 255, 0.3);
            --danger: #dc2626;
            --success: #059669;
            --warning: #d97706;
        }
        .dark {
            --bg-main: #0f172a;
            --bg-card: #1e293b;
            --text-main: #f1f5f9;
            --text-sub: #94a3b8;
            --border: #334155;
            --glass-bg: rgba(30, 41, 59, 0.8);
            --glass-border: rgba(255, 255, 255, 0.1);
        }
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Inter',sans-serif; background-color:var(--bg-main); color:var(--text-main); transition:background-color 0.3s ease; }
        .layout-wrap { display:flex; min-height:100vh; }
        .sidebar-wrap { position:sticky; top:0; height:100vh; flex-shrink:0; z-index:50; }
        .sidebar-panel { width:260px; height:100%; background:var(--bg-card); border-right:1px solid var(--border); display:flex; flex-direction:column; padding:2rem 1.25rem; overflow:hidden; transition:width 0.35s ease, padding 0.35s ease, background-color 0.3s ease; }
        .sidebar-panel.collapsed { width:72px; padding:2rem 0.75rem; }
        .sidebar-panel.collapsed .nav-lbl { display:none; }
        .sidebar-panel.collapsed .s-link { justify-content:center; padding:0.7rem 0; }
        .sidebar-panel.collapsed .s-link .t { display:none; }
        .sidebar-panel.collapsed .brand-f { display:none; }
        .sidebar-panel.collapsed .brand-s { display:block; }
        .brand-f { font-size:1.1rem; font-weight:800; color:var(--primary); text-decoration:none; white-space:nowrap; display:block; margin-bottom:2.5rem; }
        .brand-s { font-size:1.25rem; font-weight:800; color:var(--primary); text-decoration:none; display:none; text-align:center; margin-bottom:2.5rem; }
        .nav-lbl { font-size:10px; font-weight:700; color:var(--text-sub); text-transform:uppercase; letter-spacing:0.08em; padding:0 0.5rem; margin:1.25rem 0 0.5rem; white-space:nowrap; display:block; }
        .s-link { display:flex; align-items:center; gap:0.75rem; padding:0.7rem 0.75rem; border-radius:14px; color:var(--text-sub); text-decoration:none; font-weight:600; font-size:0.875rem; transition:all 0.2s; white-space:nowrap; }
        .s-link:hover, .s-link.active { background:#f5f3ff; color:var(--primary); }
        .s-link i { flex-shrink:0; }
        .s-foot { margin-top:auto; padding-top:1rem; border-top:1px solid var(--border); }
        .toggle-btn { position:absolute; top:28px; right:-15px; width:30px; height:30px; border-radius:50%; background:var(--primary); border:3px solid #ffffff; color:#ffffff; cursor:pointer; display:flex; align-items:center; justify-content:center; z-index:9999; box-shadow:0 2px 10px rgba(79,70,229,0.4); transition:transform 0.2s; }
        .toggle-btn:hover { transform:scale(1.15); }
        .main-area { flex:1; padding:2.5rem 3rem; min-width:0; }
        .top-bar { display:flex; justify-content:space-between; align-items:center; background:var(--glass-bg); backdrop-filter:blur(12px); border:1px solid var(--glass-border); padding:1rem 2rem; border-radius:1.5rem; margin-bottom:2.5rem; position:sticky; top:1.5rem; z-index:40; box-shadow:0 1px 4px rgba(0,0,0,0.06); transition:all 0.3s ease; }
        .top-bar h2 { font-weight:700; color:var(--text-main); font-size:1.25rem; margin:0; }
        .top-bar p { font-size:0.75rem; color:var(--text-sub); margin-top:0.25rem; }
        .theme-toggle { width:40px; height:40px; border-radius:12px; background:var(--bg-card); border:1px solid var(--border); color:var(--text-main); display:flex; align-items:center; justify-content:center; cursor:pointer; transition:all 0.2s; }
        .theme-toggle:hover { background:var(--border); }
        .breadcrumb { font-size:0.75rem; color:var(--text-sub); margin-bottom:0.25rem; }
        .breadcrumb a { color:var(--text-sub); text-decoration:none; }
        .breadcrumb a:hover { color:var(--primary); }
        .breadcrumb span { color:var(--primary); font-weight:600; }
        .modern-card { background:var(--bg-card); border-radius:24px; padding:1.5rem; border:1px solid var(--border); transition:all 0.3s ease; }
        .modern-card[onclick]:hover { cursor:pointer; transform:translateY(-4px); box-shadow:0 20px 25px -5px rgba(0,0,0,0.05); border-color:var(--primary); }
        .btn-indigo { display:inline-flex; align-items:center; gap:0.5rem; background:var(--primary); color:white; padding:0.6rem 1.25rem; border-radius:12px; border:none; font-weight:600; font-size:0.875rem; cursor:pointer; transition:all 0.3s; text-decoration:none; }
        .btn-indigo:hover { transform:translateY(-2px); filter:brightness(1.1); box-shadow:0 10px 15px -3px rgba(79,70,229,0.3); }
        .btn-success { display:inline-flex; align-items:center; gap:0.5rem; background:var(--success); color:white; padding:0.6rem 1.25rem; border-radius:12px; border:none; font-weight:600; font-size:0.875rem; cursor:pointer; transition:all 0.3s; text-decoration:none; }
        .btn-success:hover { transform:translateY(-2px); filter:brightness(1.1); box-shadow:0 10px 15px -3px rgba(5,150,105,0.3); }
        .btn-outline-sm { display:inline-flex; align-items:center; gap:0.5rem; background:transparent; color:var(--text-sub); padding:0.5rem 1rem; border-radius:12px; border:1px solid var(--border); font-weight:600; font-size:0.8rem; cursor:pointer; transition:all 0.3s; text-decoration:none; }
        .btn-outline-sm:hover { border-color:var(--primary); color:var(--primary); }
        .badge-green { background:#05966915; color:var(--success); padding:0.2rem 0.6rem; border-radius:9999px; font-size:0.7rem; font-weight:700; }
        .badge-red { background:#dc262615; color:var(--danger); padding:0.2rem 0.6rem; border-radius:9999px; font-size:0.7rem; font-weight:700; }
        .badge-yellow { background:#d9770615; color:var(--warning); padding:0.2rem 0.6rem; border-radius:9999px; font-size:0.7rem; font-weight:700; }
        table { width:100%; border-collapse:collapse; font-size:0.85rem; }
        th { text-align:left; padding:0.75rem 0.5rem; font-size:0.7rem; font-weight:700; color:var(--text-sub); text-transform:uppercase; border-bottom:2px solid var(--border); }
        td { padding:0.75rem 0.5rem; border-bottom:1px solid var(--border); }
        .table-wrapper { overflow-x:auto; }
        input, select, textarea { font-family:'Inter',sans-serif; }
        @media (max-width:1024px) {
            .sidebar-wrap { position:fixed; left:-280px; transition:left 0.3s ease; z-index:1000; }
            .sidebar-wrap.active { left:0; }
            .sidebar-panel { width:280px !important; }
            .main-area { padding:1.5rem; }
            .top-bar { padding:0.75rem 1rem; margin-bottom:1.5rem; top:0.5rem; }
            .toggle-btn { right:-45px; background:var(--primary); border-color:var(--bg-card); }
            .sidebar-overlay { display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); backdrop-filter:blur(4px); z-index:900; }
            .sidebar-overlay.active { display:block; }
            div[style*="grid-template-columns: 1fr 1fr"] { grid-template-columns:1fr !important; }
            .stat-grid { grid-template-columns:1fr 1fr !important; }
        }
    </style>
    @yield('styles')
</head>
<body>
@php
    $path = request()->path();
    $smartRole = 'guru';
    if (str_contains($path, '/kepsek/') || str_contains($path, '/smart-school/kepsek') && !str_contains($path, '/guru/')) $smartRole = 'kepsek';
    if (str_contains($path, '/admin/')) $smartRole = 'admin';
    $isActive = function($url) use ($path) { return $path === $url ? 'active' : ''; };
@endphp
<div class="sidebar-overlay" id="sidebarOverlay"></div>
<div class="layout-wrap">
    <div class="sidebar-wrap">
        <button class="toggle-btn" id="toggleBtn" title="Toggle Sidebar">
            <svg id="toggleSvg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
        </button>
        <div class="sidebar-panel" id="sidebarPanel">
            <a href="/demo/smart-school" class="brand-f">SMART SCHOOL</a>
            <a href="/demo/smart-school" class="brand-s">SS</a>
            <nav style="display:flex;flex-direction:column;gap:0.2rem;flex:1;overflow-y:auto;">
            @if($smartRole === 'guru')
                <span class="nav-lbl">Guru</span>
                <a href="/demo/smart-school/guru" class="s-link {{ $isActive('demo/smart-school/guru') }}"><i data-lucide="layout-dashboard" style="width:18px;"></i><span class="t">Dashboard</span></a>
                <span class="nav-lbl" style="margin-top:0.5rem;">Perangkat Ajar</span>
                <a href="/demo/smart-school/guru/modul" class="s-link {{ $isActive('demo/smart-school/guru/modul') }}"><i data-lucide="book-open" style="width:18px;"></i><span class="t">Daftar Modul</span></a>
                <a href="/demo/smart-school/guru/modul/editor" class="s-link {{ $isActive('demo/smart-school/guru/modul/editor') }}"><i data-lucide="edit" style="width:18px;"></i><span class="t">Editor Modul</span></a>
                <a href="/demo/smart-school/guru/modul/download" class="s-link {{ $isActive('demo/smart-school/guru/modul/download') }}"><i data-lucide="download" style="width:18px;"></i><span class="t">Download Center</span></a>
                <span class="nav-lbl" style="margin-top:0.5rem;">Administrasi</span>
                <a href="/demo/smart-school/guru/asesmen" class="s-link {{ $isActive('demo/smart-school/guru/asesmen') }}"><i data-lucide="clipboard-list" style="width:18px;"></i><span class="t">Asesmen & Nilai</span></a>
                <a href="/demo/smart-school/guru/narasi" class="s-link {{ $isActive('demo/smart-school/guru/narasi') }}"><i data-lucide="file-text" style="width:18px;"></i><span class="t">Generator Narasi</span></a>
                <a href="/demo/smart-school/guru/jurnal" class="s-link {{ $isActive('demo/smart-school/guru/jurnal') }}"><i data-lucide="book" style="width:18px;"></i><span class="t">Jurnal Harian</span></a>
                <a href="/demo/smart-school/guru/presensi" class="s-link {{ $isActive('demo/smart-school/guru/presensi') }}"><i data-lucide="users" style="width:18px;"></i><span class="t">Presensi</span></a>
                <a href="/demo/smart-school/guru/remedial" class="s-link {{ $isActive('demo/smart-school/guru/remedial') }}"><i data-lucide="alert-triangle" style="width:18px;"></i><span class="t">Smart Remedial</span></a>
                <span class="nav-lbl" style="margin-top:0.5rem;">Laporan</span>
                <a href="/demo/smart-school/guru/rapor" class="s-link {{ $isActive('demo/smart-school/guru/rapor') }}"><i data-lucide="file-text" style="width:18px;"></i><span class="t">Cetak Rapor</span></a>
            @elseif($smartRole === 'kepsek')
                <span class="nav-lbl">Kepala Sekolah</span>
                <a href="/demo/smart-school/kepsek" class="s-link {{ $isActive('demo/smart-school/kepsek') }}"><i data-lucide="layout-dashboard" style="width:18px;"></i><span class="t">Dashboard Supervisi</span></a>
                <span class="nav-lbl" style="margin-top:0.5rem;">Monitoring</span>
                <a href="/demo/smart-school/kepsek/smart-mapping" class="s-link {{ $isActive('demo/smart-school/kepsek/smart-mapping') }}"><i data-lucide="bar-chart-3" style="width:18px;"></i><span class="t">Smart Mapping</span></a>
                <a href="/demo/smart-school/kepsek/supervisi-jurnal" class="s-link {{ $isActive('demo/smart-school/kepsek/supervisi-jurnal') }}"><i data-lucide="activity" style="width:18px;"></i><span class="t">Supervisi Jurnal</span></a>
                <span class="nav-lbl" style="margin-top:0.5rem;">Dokumen</span>
                <a href="/demo/smart-school/kepsek/export" class="s-link {{ $isActive('demo/smart-school/kepsek/export') }}"><i data-lucide="download" style="width:18px;"></i><span class="t">Export Laporan</span></a>
            @elseif($smartRole === 'admin')
                <span class="nav-lbl">Administrator</span>
                <a href="/demo/smart-school/admin" class="s-link {{ $isActive('demo/smart-school/admin') }}"><i data-lucide="users" style="width:18px;"></i><span class="t">Manajemen Pengguna</span></a>
                <a href="/demo/smart-school/admin/konfigurasi" class="s-link {{ $isActive('demo/smart-school/admin/konfigurasi') }}"><i data-lucide="settings" style="width:18px;"></i><span class="t">Konfigurasi Sistem</span></a>
                <a href="/demo/smart-school/admin/log" class="s-link {{ $isActive('demo/smart-school/admin/log') }}"><i data-lucide="activity" style="width:18px;"></i><span class="t">Log Sistem</span></a>
            @endif
            </nav>
            <div class="s-foot">
                <a href="/demo/smart-school" class="s-link"><i data-lucide="arrow-left" style="width:18px;"></i><span class="t">Pilih Role</span></a>
            </div>
        </div>
    </div>
    <main class="main-area">
        <div class="top-bar" style="background:var(--glass-bg);border-color:var(--glass-border);">
            <div>
                <div class="breadcrumb"><a href="/demo/smart-school">Smart School</a> @hasSection('breadcrumb') / @yield('breadcrumb') @endif</div>
                <h2>@yield('page_header')</h2>
                <p>@yield('page_subtitle')</p>
            </div>
            <div style="display:flex;gap:1.5rem;align-items:center;">
                <button class="theme-toggle" id="themeToggle" title="Toggle Dark Mode">
                    <svg id="themeIcon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
                </button>
                <a href="/demo" class="btn-outline-sm" style="text-decoration:none;">&larr; Keluar</a>
            </div>
        </div>
        @yield('content')
    </main>
</div>
<script>
(function(){
    var panel=document.getElementById('sidebarPanel'),btn=document.getElementById('toggleBtn'),svg=document.getElementById('toggleSvg');
    var LEFT='<polyline points="15 18 9 12 15 6"></polyline>',RIGHT='<polyline points="9 18 15 12 9 6"></polyline>';
    function toggle(c){if(c){panel.classList.add('collapsed');svg.innerHTML=RIGHT;}else{panel.classList.remove('collapsed');svg.innerHTML=LEFT;}try{localStorage.setItem('sb',c?'1':'0');}catch(e){}}
    try{toggle(localStorage.getItem('sb')==='1');}catch(e){}
    var themeBtn=document.getElementById('themeToggle'),themeIcon=document.getElementById('themeIcon'),html=document.documentElement;
    var moon='<path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>';
    var sun='<circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>';
    function setTheme(d){if(d){html.classList.add('dark');themeIcon.innerHTML=sun;}else{html.classList.remove('dark');themeIcon.innerHTML=moon;}try{localStorage.setItem('theme',d?'dark':'light');}catch(e){}}
    try{setTheme(localStorage.getItem('theme')==='dark');}catch(e){}
    themeBtn.onclick=function(){setTheme(!html.classList.contains('dark'));};
    var overlay=document.getElementById('sidebarOverlay'),swrap=document.querySelector('.sidebar-wrap');
    function toggleMobile(){if(window.innerWidth<=1024){swrap.classList.toggle('active');overlay.classList.toggle('active');}else{toggle(!panel.classList.contains('collapsed'));}}
    btn.onclick=toggleMobile;overlay.onclick=toggleMobile;
})();
try{lucide.createIcons();}catch(e){}
</script>
@yield('scripts')
</body>
</html>
