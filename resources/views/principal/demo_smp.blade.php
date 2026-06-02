<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kepala Sekolah SMP - Top Exam (Demo)</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        :root { --bg-main:#f1f5f9; --bg-card:#ffffff; --text-main:#1e293b; --text-sub:#94a3b8; --border:#e2e8f0; --topbar-bg:rgba(255,255,255,0.8); }
        .dark { --bg-main:#0f172a; --bg-card:#1e293b; --text-main:#f1f5f9; --text-sub:#94a3b8; --border:#334155; --topbar-bg:rgba(30,41,59,0.8); }
        body { font-family:'Inter',sans-serif; background:var(--bg-main); color:var(--text-main); transition:background-color 0.3s ease; }
        .topbar { background:var(--topbar-bg); backdrop-filter:blur(12px); border-bottom:1px solid var(--border); padding:1rem 2.5rem; display:flex; justify-content:space-between; align-items:center; position:sticky; top:0; z-index:50; }
        .topbar h1 { font-size:1.25rem; font-weight:700; }
        .topbar .badge { background:#05966915; color:#059669; padding:0.3rem 0.8rem; border-radius:9999px; font-size:0.75rem; font-weight:700; }
        .theme-toggle { width:40px; height:40px; border-radius:12px; background:var(--bg-card); border:1px solid var(--border); color:var(--text-main); display:flex; align-items:center; justify-content:center; cursor:pointer; transition:all 0.2s; }
        .theme-toggle:hover { background:var(--border); }
        .container { max-width:1400px; margin:0 auto; padding:2rem; }
        .school-info { background:var(--bg-card); border-radius:20px; padding:1.5rem 2rem; margin-bottom:2rem; border-left:4px solid #4f46e5; display:flex; justify-content:space-between; align-items:center; }
        .school-info h2 { font-size:1.5rem; }
        .school-info .jenjang { background:#4f46e515; color:#4f46e5; padding:0.3rem 1rem; border-radius:9999px; font-size:0.8rem; font-weight:700; }
        .stats { display:grid; grid-template-columns:repeat(5,1fr); gap:1.5rem; margin-bottom:2rem; }
        .stat-card { background:var(--bg-card); border-radius:20px; padding:1.5rem; cursor:pointer; transition:all 0.2s; text-decoration:none; display:block; color:inherit; }
        .stat-card:hover { transform:translateY(-2px); box-shadow:0 8px 25px rgba(0,0,0,0.08); }
        .stat-card .label { font-size:0.7rem; font-weight:700; color:var(--text-sub); text-transform:uppercase; margin-bottom:0.5rem; }
        .stat-card .value { font-size:2rem; font-weight:800; }
        .stat-card .sub { font-size:0.75rem; color:var(--text-sub); margin-top:0.5rem; }
        .grid-2 { display:grid; grid-template-columns:1fr 1fr; gap:2rem; margin-bottom:2rem; }
        .card { background:var(--bg-card); border-radius:20px; padding:1.5rem; }
        .card h3 { font-size:1rem; font-weight:700; margin-bottom:1.25rem; }
        table { width:100%; border-collapse:collapse; font-size:0.85rem; }
        th { text-align:left; padding:0.75rem 0.5rem; font-size:0.7rem; font-weight:700; color:var(--text-sub); text-transform:uppercase; border-bottom:2px solid var(--border); }
        td { padding:0.75rem 0.5rem; border-bottom:1px solid var(--border); }
        .progress { width:60px; height:8px; background:#e2e8f0; border-radius:4px; overflow:hidden; margin:0 auto; }
        .progress-fill { height:100%; border-radius:4px; }
        .chart-container { position:relative; height:280px; }
        .class-table th, .class-table td { text-align:center; }
        .class-table td:first-child { text-align:left; font-weight:600; }
        .badge-green { background:#05966915; color:#059669; padding:0.2rem 0.6rem; border-radius:9999px; font-size:0.7rem; font-weight:700; }
        .badge-red { background:#dc262615; color:#dc2626; padding:0.2rem 0.6rem; border-radius:9999px; font-size:0.7rem; font-weight:700; }
        .badge-yellow { background:#d9770615; color:#d97706; padding:0.2rem 0.6rem; border-radius:9999px; font-size:0.7rem; font-weight:700; }
    </style>
</head>
<body>

<div class="topbar">
    <div style="display:flex; align-items:center; gap:0.75rem;">
        <div style="width:36px;height:36px;background:#4f46e5;border-radius:10px;display:flex;align-items:center;justify-content:center;color:white;">
            <i data-lucide="graduation-cap" style="width:20px;"></i>
        </div>
        <h1>Top Exam <span style="color:#94a3b8;font-weight:400;">— Dashboard Kepsek SMP</span></h1>
    </div>
    <div style="display:flex; align-items:center; gap:1rem;">
        <span class="badge">DEMO</span>
        <button class="theme-toggle" id="themeToggle" title="Toggle Dark Mode">
            <svg id="themeIcon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
            </svg>
        </button>
        <a href="{{ url('/login') }}" style="color:#dc2626;font-size:0.8rem;font-weight:600;text-decoration:none;">Keluar</a>
    </div>
</div>

<div class="container">
    <div class="school-info">
        <div>
            <p style="font-size:0.75rem;font-weight:700;color:#94a3b8;text-transform:uppercase;">Sekolah</p>
            <h2>SMP NEGERI 1 HARAPAN BANGSA</h2>
        </div>
        <div style="text-align:right;">
            <span class="jenjang">SMP</span>
            <p style="font-size:0.75rem;color:#94a3b8;margin-top:0.25rem;">NPSN: 20123457</p>
        </div>
    </div>

    <!-- Stats -->
    <div class="stats">
        <a href="{{ url('/demo/smp/principal/student-mastery') }}" class="stat-card" style="border-left:4px solid #4f46e5;">
            <div class="label">Rata-rata Mastery</div>
            <div class="value" style="color:var(--text-main);">78.3</div>
            <div class="sub">Skor rata-rata seluruh siswa</div>
        </a>
        <a href="{{ url('/demo/smp/principal/excellent') }}" class="stat-card" style="border-left:4px solid #059669;">
            <div class="label">Excellent Rate</div>
            <div class="value" style="color:#059669;">64%</div>
            <div class="sub">23 siswa di atas target (75)</div>
        </a>
        <a href="{{ url('/demo/smp/principal/alert') }}" class="stat-card" style="border-left:4px solid #dc2626;">
            <div class="label">Alert Rate</div>
            <div class="value" style="color:#dc2626;">22%</div>
            <div class="sub">8 siswa di bawah KKM (70)</div>
        </a>
        <a href="{{ url('/demo/smp/principal/alert-groups') }}" class="stat-card" style="border-left:4px solid #dc2626;">
            <div class="label">Kelompok Alert</div>
            <div class="value" style="color:#dc2626;">12 <span style="font-size:0.85rem;font-weight:400;color:#94a3b8;">Kelompok</span></div>
            <div class="sub">Topik dengan siswa di bawah KKM</div>
        </a>
        <div class="stat-card" style="border-left:4px solid #d97706;">
            <div class="label">Rata-rata Growth</div>
            <div class="value" style="color:#d97706;">+4.7%</div>
            <div class="sub">Pertumbuhan dari 36 siswa</div>
        </div>
    </div>

    <div class="grid-2">
        <!-- Subject Heatmap -->
        <div class="card">
            <h3>Subject Heatmap</h3>
            <table>
                <thead>
                    <tr><th>Mata Pelajaran</th><th style="text-align:center;">Siswa</th><th style="text-align:center;">Rata-rata</th><th style="text-align:center;">Excellent</th></tr>
                </thead>
                <tbody>
                    <tr><td style="font-weight:600;">Matematika</td><td style="text-align:center;">36</td><td style="text-align:center;font-weight:700;color:#059669;">78.5</td><td style="text-align:center;"><div class="progress"><div class="progress-fill" style="width:64%;background:#059669;"></div></div></td></tr>
                    <tr><td style="font-weight:600;">Bahasa Indonesia</td><td style="text-align:center;">36</td><td style="text-align:center;font-weight:700;color:#059669;">82.1</td><td style="text-align:center;"><div class="progress"><div class="progress-fill" style="width:72%;background:#059669;"></div></div></td></tr>
                </tbody>
            </table>
        </div>

        <!-- Growth Line Chart -->
        <div class="card">
            <h3>Growth per Mapel</h3>
            <p style="font-size:0.75rem;color:#94a3b8;margin-bottom:1rem;">Tren rata-rata nilai per mata pelajaran</p>
            <div class="chart-container">
                <canvas id="growthChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Class Matrix -->
    <div class="card" style="margin-bottom:2rem;">
        <h3>Matriks Komparatif Antar Kelas</h3>
        <table class="class-table">
            <thead>
                <tr><th>Kelas</th><th>Jumlah Siswa</th><th>Rata-rata Skor</th><th>Growth</th><th>Excellent Rate</th><th>Status</th></tr>
            </thead>
            <tbody>
                <tr><td>7A</td><td>18</td><td style="font-weight:700;color:#059669;">82.4</td><td style="color:#059669;font-weight:700;">↑ 4.2%</td><td>72%</td><td><span class="badge-green">HEALTHY</span></td></tr>
                <tr><td>7B</td><td>18</td><td style="font-weight:700;color:#059669;">76.8</td><td style="color:#059669;font-weight:700;">↑ 3.1%</td><td>56%</td><td><span class="badge-yellow">WARNING</span></td></tr>
                <tr><td>7C</td><td>18</td><td style="font-weight:700;color:#d97706;">68.2</td><td style="color:#059669;font-weight:700;">↑ 1.8%</td><td>28%</td><td><span class="badge-yellow">WARNING</span></td></tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    lucide.createIcons();

    // Dark mode toggle
    (function() {
        var themeBtn = document.getElementById('themeToggle');
        var themeIcon = document.getElementById('themeIcon');
        var html = document.documentElement;
        const moonIcon = '<path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>';
        const sunIcon  = '<circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>';
        function setTheme(isDark) {
            if (isDark) { html.classList.add('dark'); themeIcon.innerHTML = sunIcon; }
            else { html.classList.remove('dark'); themeIcon.innerHTML = moonIcon; }
            try { localStorage.setItem('theme', isDark ? 'dark' : 'light'); } catch(e) {}
        }
        try { setTheme(localStorage.getItem('theme') === 'dark'); } catch(e) {}
        themeBtn.onclick = function() { setTheme(!html.classList.contains('dark')); };
    })();

    new Chart(document.getElementById('growthChart'), {
        type: 'line',
        data: {
            labels: ['Ke-1', 'Ke-2', 'Ke-3'],
            datasets: [
                { label: 'Matematika', data: [45, 55, 75], borderColor: '#4f46e5', backgroundColor: 'rgba(79,70,229,0.1)', fill: true, tension: 0.3, pointRadius: 4, borderWidth: 2 },
                { label: 'Bahasa Indonesia', data: [60, 75, 85], borderColor: '#059669', backgroundColor: 'rgba(5,150,105,0.1)', fill: true, tension: 0.3, pointRadius: 4, borderWidth: 2 }
            ]
        },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 11 } } } },
            scales: {
                y: { beginAtZero: true, max: 100, title: { display: true, text: 'Nilai Rata-rata', font: { size: 11 } }, grid: { color: 'rgba(0,0,0,0.05)' } },
                x: { title: { display: true, text: 'Quiz Ke-', font: { size: 11 } }, grid: { display: false } }
            }
        }
    });
</script>
</body>
</html>
