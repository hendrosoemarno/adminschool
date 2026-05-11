<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'AI Learning Dashboard')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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

        body { background-color: var(--bg-main); color: var(--text-main); transition: background-color 0.3s ease; }
        
        .layout-wrap { display: flex; min-height: 100vh; }

        /* Sidebar wrapper */
        .sidebar-wrap {
            position: sticky;
            top: 0;
            height: 100vh;
            flex-shrink: 0;
            position: relative;
            z-index: 50;
        }

        /* The actual sidebar panel */
        .sidebar-panel {
            width: 260px;
            height: 100%;
            background: var(--bg-card);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            padding: 2rem 1.25rem;
            overflow: hidden;
            transition: width 0.35s ease, padding 0.35s ease, background-color 0.3s ease;
        }
        .sidebar-panel.collapsed { width: 72px; padding: 2rem 0.75rem; }

        /* Toggle Button Styles */
        .theme-toggle {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: var(--bg-card);
            border: 1px solid var(--border);
            color: var(--text-main);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
        }
        .theme-toggle:hover { background: var(--border); }

        /* Toggle — base styles */
        .toggle-btn {
            position: absolute;
            top: 28px;
            right: -15px;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #4f46e5;
            border: 3px solid #ffffff;
            color: #ffffff;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            box-shadow: 0 2px 10px rgba(79,70,229,0.4);
            transition: transform 0.2s;
        }
        .toggle-btn:hover { transform: scale(1.15); }

        /* Mobile Responsive Styles */
        @media (max-width: 1024px) {
            .sidebar-wrap {
                position: fixed;
                left: -280px;
                transition: left 0.3s ease;
                z-index: 1000;
            }
            .sidebar-wrap.active { left: 0; }
            .sidebar-panel { width: 280px !important; }
            
            .main-area { padding: 1.5rem; }
            .top-bar { padding: 0.75rem 1rem; margin-bottom: 1.5rem; top: 0.5rem; }
            
            .toggle-btn {
                right: -45px;
                background: var(--primary);
                border-color: var(--bg-card);
            }

            .stat-group, 
            div[style*="grid-template-columns: 1fr 1fr"],
            div[style*="grid-template-columns: 1fr 1.5fr"],
            div[style*="grid-template-columns: 2fr 1fr"] {
                grid-template-columns: 1fr !important;
            }

            .table-wrapper { overflow-x: auto; }
            table { min-width: 600px; }
        }

        /* Overlay for mobile sidebar */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            backdrop-filter: blur(4px);
            z-index: 900;
        }
        .sidebar-overlay.active { display: block; }

        /* Brand */
        .brand-f { font-size:1.1rem; font-weight:800; color:#4f46e5; text-decoration:none; white-space:nowrap; display:block; margin-bottom:2.5rem; }
        .brand-s { font-size:1.25rem; font-weight:800; color:#4f46e5; text-decoration:none; display:none; text-align:center; margin-bottom:2.5rem; }
        .sidebar-panel.collapsed .brand-f { display:none; }
        .sidebar-panel.collapsed .brand-s { display:block; }

        /* Section labels */
        .nav-lbl { font-size:10px; font-weight:700; color:#94a3b8; text-transform:uppercase; letter-spacing:0.08em; padding:0 0.5rem; margin:1.25rem 0 0.5rem; white-space:nowrap; display:block; }
        .sidebar-panel.collapsed .nav-lbl { display:none; }

        /* Nav links */
        .s-link { display:flex; align-items:center; gap:0.75rem; padding:0.7rem 0.75rem; border-radius:14px; color:#64748b; text-decoration:none; font-weight:600; font-size:0.875rem; transition:all 0.2s; white-space:nowrap; }
        .s-link:hover, .s-link.active { background:#f5f3ff; color:#4f46e5; }
        .s-link i { flex-shrink:0; }
        .sidebar-panel.collapsed .s-link { justify-content:center; padding:0.7rem 0; }
        .sidebar-panel.collapsed .s-link .t { display:none; }

        /* Footer */
        .s-foot { margin-top:auto; padding-top:1rem; border-top:1px solid #f1f5f9; }

        /* Main content */
        .main-area { flex:1; padding:2.5rem 3rem; min-width:0; }
        
        /* Interactive Elements */
        .btn-indigo {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--primary);
            color: white;
            padding: 0.6rem 1.25rem;
            border-radius: 12px;
            border: none;
            font-weight: 600;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-indigo:hover {
            transform: translateY(-2px);
            filter: brightness(1.1);
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);
        }

        .btn-indigo:active {
            transform: translateY(0);
        }

        .modern-card {
            background: var(--bg-card);
            border-radius: 24px;
            padding: 1.5rem;
            border: 1px solid var(--border);
            transition: all 0.3s ease;
        }

        .modern-card[onclick]:hover {
            cursor: pointer;
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);
            border-color: var(--primary);
        }

        .top-bar {
            display:flex; justify-content:space-between; align-items:center;
            background:rgba(255,255,255,0.75); backdrop-filter:blur(12px);
            border:1px solid rgba(255,255,255,0.3); padding:1rem 2rem;
            border-radius:1.5rem; margin-bottom:2.5rem;
            position:sticky; top:1.5rem; z-index:40;
            box-shadow:0 1px 4px rgba(0,0,0,0.06);
            transition: all 0.3s ease;
        }
    </style>
</head>
<body>
<div class="sidebar-overlay" id="sidebarOverlay"></div>
<div class="layout-wrap">

    {{-- Sidebar wrapper --}}
    <div class="sidebar-wrap">

        {{-- Toggle button — OUTSIDE the overflow:hidden sidebar --}}
        <button class="toggle-btn" id="toggleBtn" title="Toggle Sidebar">
            <svg id="toggleSvg" width="14" height="14" viewBox="0 0 24 24"
                 fill="none" stroke="currentColor" stroke-width="2.5"
                 stroke-linecap="round" stroke-linejoin="round">
                <polyline points="15 18 9 12 15 6"></polyline>
            </svg>
        </button>

        {{-- Sidebar --}}
        <div class="sidebar-panel" id="sidebarPanel">
            <a href="/" class="brand-f">AI LEARNING</a>
            <a href="/" class="brand-s">AI</a>

            <nav style="display:flex;flex-direction:column;gap:0.2rem;flex:1;overflow-y:auto;">
                @if(session('moodle_user.role') === 'admin')
                    <span class="nav-lbl">Administrator</span>
                    <a href="/admin/dashboard" class="s-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <i data-lucide="layout-dashboard" style="width:18px;height:18px;"></i>
                        <span class="t">Dashboard Admin</span>
                    </a>
                    <a href="/admin/active-quizzes" class="s-link {{ request()->is('admin/active-quizzes') ? 'active' : '' }}">
                        <i data-lucide="check-square" style="width:18px;height:18px;"></i>
                        <span class="t">Active Quizzes</span>
                    </a>
                    <a href="/admin/org-manager" class="s-link {{ request()->is('admin/org-manager') ? 'active' : '' }}">
                        <i data-lucide="building" style="width:18px;height:18px;"></i>
                        <span class="t">Kelola Sekolah</span>
                    </a>
                    <a href="/admin/smart-importer" class="s-link {{ request()->is('admin/smart-importer') ? 'active' : '' }}">
                        <i data-lucide="file-up" style="width:18px;height:18px;"></i>
                        <span class="t">Smart Importer</span>
                    </a>
                    <a href="/admin/competency-architect" class="s-link {{ request()->is('admin/competency-architect') ? 'active' : '' }}">
                        <i data-lucide="layers" style="width:18px;height:18px;"></i>
                        <span class="t">Arsitek Kompetensi</span>
                    </a>
                @endif

                @if(session('moodle_user.role') === 'principal')
                    <span class="nav-lbl">Kepala Sekolah</span>
                    <a href="/principal/dashboard" class="s-link {{ request()->is('principal/dashboard') ? 'active' : '' }}">
                        <i data-lucide="layout-dashboard" style="width:18px;height:18px;"></i>
                        <span class="t">Dashboard Kepsek</span>
                    </a>
                    <a href="/admin/org-manager" class="s-link">
                        <i data-lucide="bar-chart-3" style="width:18px;height:18px;"></i>
                        <span class="t">Laporan Akademik</span>
                    </a>
                @endif

                @if(session('moodle_user.role') === 'homeroom')
                    <span class="nav-lbl">Wali Kelas</span>
                    <a href="/homeroom/dashboard" class="s-link {{ request()->is('homeroom/dashboard') ? 'active' : '' }}">
                        <i data-lucide="layout-dashboard" style="width:18px;height:18px;"></i>
                        <span class="t">Dashboard Kelas</span>
                    </a>
                    <a href="#" class="s-link">
                        <i data-lucide="users" style="width:18px;height:18px;"></i>
                        <span class="t">Data Siswa</span>
                    </a>
                @endif

                @if(session('moodle_user.role') === 'teacher')
                    <span class="nav-lbl">Guru Pengajar</span>
                    <a href="/teacher/dashboard" class="s-link {{ request()->is('teacher/dashboard') ? 'active' : '' }}">
                        <i data-lucide="layout-dashboard" style="width:18px;height:18px;"></i>
                        <span class="t">Dashboard Guru</span>
                    </a>
                    <a href="#" class="s-link">
                        <i data-lucide="book-open" style="width:18px;height:18px;"></i>
                        <span class="t">Mata Pelajaran</span>
                    </a>
                @endif

                @if(session('moodle_user.role') === 'student')
                    <span class="nav-lbl">Siswa</span>
                    <a href="/student/dashboard" class="s-link {{ request()->is('student/dashboard') ? 'active' : '' }}">
                        <i data-lucide="layout-dashboard" style="width:18px;height:18px;"></i>
                        <span class="t">Dashboard Siswa</span>
                    </a>
                    <a href="/student/dashboard" class="s-link">
                        <i data-lucide="user" style="width:18px;height:18px;"></i>
                        <span class="t">Profil Kompetensi</span>
                    </a>
                @endif
            </nav>

            <div class="s-foot">
                <a href="/logout" class="s-link" style="color:#e11d48;">
                    <i data-lucide="log-out" style="width:18px;height:18px;"></i>
                    <span class="t">Keluar</span>
                </a>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <main class="main-area">
        <div class="top-bar" style="background: var(--glass-bg); border-color: var(--glass-border); transition: background-color 0.3s ease;">
            <div>
                <div style="display:flex; align-items:center; gap:0.75rem;">
                    <h2 style="font-weight:700;color:var(--text-main);font-size:1.25rem;margin:0;">@yield('page_header','Selamat Datang')</h2>
                    @hasSection('school_badge')
                        <div style="background:var(--primary-light,#e0e7ff); color:var(--primary,#4f46e5); padding:0.2rem 0.6rem; border-radius:6px; font-size:0.7rem; font-weight:700; letter-spacing:0.05em; border:1px solid #c7d2fe;">
                            <i data-lucide="building" style="width:12px;height:12px;display:inline-block;margin-right:2px;vertical-align:middle;"></i>
                            @yield('school_badge')
                        </div>
                    @endif
                </div>
                <p style="font-size:0.75rem;color:var(--text-sub);margin-top:0.25rem;">@yield('page_subtitle','Pantau perkembangan kompetensi hari ini.')</p>
            </div>
            <div style="display:flex;gap:1.5rem;align-items:center;">
                <!-- Theme Toggle Button -->
                <button class="theme-toggle" id="themeToggle" title="Toggle Dark Mode">
                    <svg id="themeIcon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                    </svg>
                </button>

                <div style="display:flex;gap:1rem;align-items:center;">
                    <div style="text-align:right;">
                        <p style="font-size:0.875rem;font-weight:700;color:var(--text-main);">{{ session('moodle_user.fullname') }}</p>
                        <p style="font-size:0.75rem;color:var(--text-sub);text-transform:uppercase;font-weight:600;letter-spacing:0.05em;">{{ session('moodle_user.role') }}</p>
                    </div>
                    <div style="width:42px;height:42px;background:#4f46e5;border-radius:12px;display:flex;align-items:center;justify-content:center;color:white;font-weight:800;text-transform:uppercase;">
                        {{ substr(session('moodle_user.fullname'), 0, 2) }}
                    </div>
                </div>
            </div>
        </div>
        @yield('content')
    </main>
</div>

{{-- Toggle script FIRST, before Lucide, so it always works --}}
<script>
    (function() {
        var panel = document.getElementById('sidebarPanel');
        var btn   = document.getElementById('toggleBtn');
        var svg   = document.getElementById('toggleSvg');

        var LEFT  = '<polyline points="15 18 9 12 15 6"></polyline>';
        var RIGHT = '<polyline points="9 18 15 12 9 6"></polyline>';

        function toggle(collapsed) {
            if (collapsed) {
                panel.classList.add('collapsed');
                svg.innerHTML = RIGHT;
            } else {
                panel.classList.remove('collapsed');
                svg.innerHTML = LEFT;
            }
            try { localStorage.setItem('sb', collapsed ? '1' : '0'); } catch(e) {}
        }

        // Restore state
        try { toggle(localStorage.getItem('sb') === '1'); } catch(e) {}

        btn.onclick = function() {
            toggle(!panel.classList.contains('collapsed'));
        };

        // Theme Toggle Logic
        var themeBtn = document.getElementById('themeToggle');
        var themeIcon = document.getElementById('themeIcon');
        var html = document.documentElement;

        // SVG paths for Moon and Sun
        const moonIcon = '<path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>';
        const sunIcon  = '<circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>';

        function setTheme(isDark) {
            if (isDark) {
                html.classList.add('dark');
                themeIcon.innerHTML = sunIcon;
            } else {
                html.classList.remove('dark');
                themeIcon.innerHTML = moonIcon;
            }
            try { localStorage.setItem('theme', isDark ? 'dark' : 'light'); } catch(e) {}
        }

        // Restore theme
        try { setTheme(localStorage.getItem('theme') === 'dark'); } catch(e) {}

        themeBtn.onclick = function() {
            setTheme(!html.classList.contains('dark'));
        };

        // Mobile Sidebar Logic
        var overlay = document.getElementById('sidebarOverlay');
        var sidebarWrap = document.querySelector('.sidebar-wrap');

        function toggleMobileSidebar() {
            if (window.innerWidth <= 1024) {
                sidebarWrap.classList.toggle('active');
                overlay.classList.toggle('active');
            } else {
                toggle(!panel.classList.contains('collapsed'));
            }
        }

        btn.onclick = toggleMobileSidebar;
        overlay.onclick = toggleMobileSidebar;
    })();
</script>

{{-- Lucide icons --}}
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    try {
        lucide.createIcons();
    } catch(e) {
        console.error('Lucide error:', e);
    }
</script>
</body>
</html>