<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Exam — AI-Powered Diagnostic Mapping for Schools</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Inter',sans-serif; background:#fff; color:#0a1a2f; overflow-x:hidden; }
        .container { max-width:1200px; margin:0 auto; padding:0 2rem; }

        /* ---- NAV ---- */
        nav { display:flex; justify-content:space-between; align-items:center; padding:1.5rem 2rem; max-width:1200px; margin:0 auto; }
        .logo { display:flex; align-items:center; gap:0.75rem; font-weight:800; font-size:1.5rem; color:#0a1a2f; text-decoration:none; }
        .logo-icon { width:42px; height:42px; background:linear-gradient(135deg,#059669,#0a1a2f); border-radius:12px; display:flex; align-items:center; justify-content:center; color:#fff; }
        nav a:not(.logo) { color:#64748b; text-decoration:none; font-size:0.9rem; font-weight:600; transition:color 0.2s; }
        nav a:not(.logo):hover { color:#059669; }
        .nav-cta { background:#059669; color:#fff !important; padding:0.6rem 1.5rem; border-radius:999px; font-weight:700; transition:all 0.3s; }
        .nav-cta:hover { background:#047857; transform:translateY(-1px); }

        /* ---- HERO ---- */
        .hero { display:flex; align-items:center; gap:4rem; padding:4rem 0 6rem; position:relative; }
        .hero-text { flex:1; }
        .hero-badge { display:inline-flex; align-items:center; gap:0.5rem; background:#05966910; color:#059669; padding:0.4rem 1rem; border-radius:999px; font-size:0.8rem; font-weight:700; margin-bottom:1.5rem; }
        .hero h1 { font-size:3.5rem; font-weight:900; line-height:1.1; letter-spacing:-1px; margin-bottom:1.5rem; }
        .hero h1 span { background:linear-gradient(135deg,#059669,#0a1a2f); -webkit-background-clip:text; -webkit-text-fill-color:transparent; }
        .hero p { font-size:1.15rem; color:#64748b; line-height:1.7; max-width:540px; margin-bottom:2.5rem; }
        .hero-btns { display:flex; gap:1rem; }
        .btn-primary { background:#059669; color:#fff; padding:1rem 2.5rem; border-radius:999px; font-weight:700; text-decoration:none; font-size:1rem; transition:all 0.3s; display:inline-flex; align-items:center; gap:0.5rem; }
        .btn-primary:hover { background:#047857; transform:translateY(-2px); box-shadow:0 10px 30px -5px rgba(5,150,105,0.3); }
        .btn-outline { border:2px solid #e2e8f0; color:#0a1a2f; padding:1rem 2.5rem; border-radius:999px; font-weight:700; text-decoration:none; font-size:1rem; transition:all 0.3s; display:inline-flex; align-items:center; gap:0.5rem; }
        .btn-outline:hover { border-color:#059669; color:#059669; }
        .hero-visual { flex:1; position:relative; height:450px; }
        .hero-glow { position:absolute; width:400px; height:400px; border-radius:50%; background:radial-gradient(circle,rgba(5,150,105,0.08),transparent 70%); top:50%; left:50%; transform:translate(-50%,-50%); }

        /* Abstract Chart Bars */
        .chart-bars { position:absolute; bottom:60px; right:20px; display:flex; align-items:flex-end; gap:12px; }
        .chart-bars .bar { width:28px; border-radius:6px 6px 0 0; background:linear-gradient(to top,rgba(5,150,105,0.6),rgba(5,150,105,0.2)); transition:height 0.3s; }
        .chart-bars .bar:nth-child(1) { height:60px; }
        .chart-bars .bar:nth-child(2) { height:100px; }
        .chart-bars .bar:nth-child(3) { height:140px; background:linear-gradient(to top,rgba(5,150,105,0.8),rgba(5,150,105,0.3)); }
        .chart-bars .bar:nth-child(4) { height:80px; }
        .chart-bars .bar:nth-child(5) { height:120px; }
        .chart-line { position:absolute; bottom:60px; right:20px; width:220px; height:2px; background:rgba(5,150,105,0.15); }
        .chart-line::after { content:''; position:absolute; top:-20px; left:0; width:100%; height:40px; background:linear-gradient(to top,rgba(5,150,105,0.05),transparent); clip-path:polygon(0 100%,10% 30%,25% 60%,40% 10%,60% 40%,80% 15%,90% 30%,100% 0,100% 100%); }

        /* Shield */
        .shield { position:absolute; top:20px; left:20px; width:80px; height:80px; border-radius:20px; background:linear-gradient(135deg,rgba(5,150,105,0.1),rgba(10,26,47,0.05)); border:1px solid rgba(5,150,105,0.15); display:flex; align-items:center; justify-content:center; backdrop-filter:blur(4px); }
        .shield i { color:#059669; width:36px; height:36px; }

        /* Circuit Tree */
        .circuit-tree { position:absolute; top:40px; right:30px; width:120px; height:160px; }
        .circuit-tree .trunk { position:absolute; bottom:0; left:50%; transform:translateX(-50%); width:3px; height:80px; background:linear-gradient(to top,#059669,transparent); border-radius:2px; }
        .circuit-tree .branch { position:absolute; background:#059669; border-radius:2px; }
        .circuit-tree .branch:nth-child(2) { width:40px; height:2px; top:60px; right:10px; }
        .circuit-tree .branch:nth-child(3) { width:30px; height:2px; top:40px; left:5px; }
        .circuit-tree .branch:nth-child(4) { width:20px; height:2px; top:25px; right:20px; }
        .circuit-leaf { width:6px; height:6px; border-radius:50%; background:#059669; position:absolute; }
        .circuit-tree .leaf1 { top:60px; right:48px; }
        .circuit-tree .leaf2 { top:40px; left:2px; }
        .circuit-tree .leaf3 { top:25px; right:38px; }

        /* Floating elements */
        .float-dot { width:12px; height:12px; border-radius:50%; background:rgba(5,150,105,0.2); position:absolute; }
        .float-dot:nth-child(1) { top:120px; right:130px; }
        .float-dot:nth-child(2) { top:200px; left:40px; width:8px; height:8px; background:rgba(5,150,105,0.3); }

        /* ---- FEATURES ---- */
        .features { padding:6rem 0; background:#f8fafc; }
        .section-label { font-size:0.8rem; font-weight:700; color:#059669; text-transform:uppercase; letter-spacing:2px; text-align:center; margin-bottom:0.75rem; }
        .section-title { font-size:2.5rem; font-weight:800; text-align:center; margin-bottom:1rem; }
        .section-sub { color:#64748b; text-align:center; max-width:600px; margin:0 auto 4rem; font-size:1.05rem; }
        .feature-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:2rem; }
        .feature-card { background:#fff; border:1px solid #f1f5f9; border-radius:24px; padding:2.5rem 2rem; transition:all 0.3s; }
        .feature-card:hover { box-shadow:0 20px 40px -10px rgba(0,0,0,0.06); transform:translateY(-4px); border-color:#e2e8f0; }
        .feature-icon { width:56px; height:56px; border-radius:16px; display:flex; align-items:center; justify-content:center; margin-bottom:1.5rem; background:linear-gradient(135deg,rgba(5,150,105,0.1),rgba(10,26,47,0.05)); color:#059669; }
        .feature-card h3 { font-size:1.2rem; font-weight:700; margin-bottom:0.75rem; }
        .feature-card p { color:#64748b; font-size:0.9rem; line-height:1.6; }

        /* Data circle */
        .data-circle { width:90px; height:90px; border-radius:50%; border:3px solid rgba(5,150,105,0.15); position:relative; margin:0 auto 2rem; }
        .data-circle::after { content:''; position:absolute; inset:10px; border-radius:50%; border:2px dashed rgba(5,150,105,0.2); animation:spin 30s linear infinite; }
        .data-circle-inner { position:absolute; inset:18px; border-radius:50%; background:rgba(5,150,105,0.08); display:flex; align-items:center; justify-content:center; }
        @keyframes spin { to { transform:rotate(360deg); } }

        /* ---- ECOSYSTEM ---- */
        .ecosystem { padding:6rem 0; }
        .eco-grid { display:grid; grid-template-columns:1fr 1fr; gap:2rem; }
        .eco-card { border-radius:24px; padding:3rem; border:1px solid #f1f5f9; transition:all 0.3s; }
        .eco-card:hover { box-shadow:0 20px 40px -10px rgba(0,0,0,0.06); border-color:#e2e8f0; }
        .eco-card .icon-wrap { width:64px; height:64px; border-radius:18px; display:flex; align-items:center; justify-content:center; margin-bottom:1.5rem; }
        .eco-card h3 { font-size:1.4rem; font-weight:700; margin-bottom:0.75rem; }
        .eco-card p { color:#64748b; font-size:0.9rem; line-height:1.7; }
        .eco-card ul { list-style:none; margin-top:1.5rem; }
        .eco-card li { display:flex; align-items:center; gap:0.75rem; padding:0.5rem 0; font-size:0.9rem; color:#475569; }
        .eco-card li i { color:#059669; width:18px; }

        .eco-card.lms .icon-wrap { background:linear-gradient(135deg,rgba(5,150,105,0.1),rgba(5,150,105,0.05)); color:#059669; }
        .eco-card.ai .icon-wrap { background:linear-gradient(135deg,rgba(10,26,47,0.08),rgba(10,26,47,0.03)); color:#0a1a2f; }

        /* ---- FOOTER ---- */
        footer { background:#0a1a2f; color:#fff; padding:3rem 2rem; text-align:center; }
        footer p { color:#64748b; font-size:0.85rem; }
        footer .logo { color:#fff; justify-content:center; margin-bottom:1rem; }

        /* ---- RESPONSIVE ---- */
        @media (max-width:900px) {
            .hero { flex-direction:column; padding:2rem 0 3rem; }
            .hero h1 { font-size:2.2rem; }
            .hero-visual { height:300px; width:100%; }
            .feature-grid { grid-template-columns:1fr; }
            .eco-grid { grid-template-columns:1fr; }
            .hero-btns { flex-direction:column; }
            nav a:not(.logo,.nav-cta) { display:none; }
        }

        /* ---- Trusted section ---- */
        .trusted { text-align:center; padding:2rem 0 4rem; }
        .trusted p { font-size:0.8rem; color:#94a3b8; font-weight:600; text-transform:uppercase; letter-spacing:1px; margin-bottom:2rem; }
        .trusted-logos { display:flex; justify-content:center; gap:3rem; align-items:center; flex-wrap:wrap; }
        .trusted-logos span { font-size:1.1rem; font-weight:700; color:#94a3b8; opacity:0.6; }
    </style>
</head>
<body>

<nav>
    <a href="/" class="logo">
        <div class="logo-icon"><i data-lucide="graduation-cap" style="width:22px;"></i></div>
        Top Exam
    </a>
    <a href="#features">Fitur</a>
    <a href="#ecosystem">Ekosistem</a>
    <a href="/login" class="nav-cta">Masuk</a>
</nav>

<!-- HERO -->
<section class="hero container">
    <div class="hero-text">
        <div class="hero-badge"><i data-lucide="sparkles" style="width:16px;"></i> AI-Powered Platform</div>
        <h1>Diagnostic Mapping<br><span>for Future-Ready Schools</span></h1>
        <p>Transform your Moodle quiz data into actionable competency insights. Real-time radar charts, growth tracking, and smart intervention alerts — all powered by artificial intelligence.</p>
        <div class="hero-btns">
            <a href="/demo" class="btn-primary"><i data-lucide="play-circle" style="width:20px;"></i> Lihat Demo</a>
            <a href="#features" class="btn-outline">Pelajari Lebih Lanjut</a>
        </div>
    </div>
    <div class="hero-visual">
        <div class="hero-glow"></div>
        <!-- Shield -->
        <div class="shield"><i data-lucide="shield-check"></i></div>
        <!-- Circuit Tree -->
        <div class="circuit-tree">
            <div class="trunk"></div>
            <div class="branch"></div>
            <div class="branch"></div>
            <div class="branch"></div>
            <div class="circuit-leaf leaf1"></div>
            <div class="circuit-leaf leaf2"></div>
            <div class="circuit-leaf leaf3"></div>
        </div>
        <!-- Chart Bars -->
        <div class="chart-bars">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
        <div class="float-dot"></div>
        <div class="float-dot"></div>
    </div>
</section>

<!-- TRUSTED -->
<div class="trusted container">
    <p>Dipercaya oleh institusi pendidikan di seluruh Indonesia</p>
    <div class="trusted-logos">
        <span>KEMDIKBUD</span>
        <span>LPDP</span>
        <span>SEAMEO</span>
        <span>RUANG GURU</span>
    </div>
</div>

<!-- FEATURES -->
<section class="features" id="features">
    <div class="container">
        <div class="section-label">— Fitur Unggulan</div>
        <h2 class="section-title">Diagnostic Mapping</h2>
        <p class="section-sub">Pemetaan kompetensi otomatis dari data tryout. Bukan sekadar nilai — tapi analisis micro-skill yang mendalam.</p>
        <div class="feature-grid">
            <div class="feature-card">
                <div class="feature-icon"><i data-lucide="radar" style="width:28px;"></i></div>
                <h3>Spider Radar</h3>
                <p>Visualisasi multi-dimensi penguasaan topik per mata pelajaran. Bandingkan kompetensi secara instan.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i data-lucide="trending-up" style="width:28px;"></i></div>
                <h3>Growth Tracker</h3>
                <p>Pantau pertumbuhan nilai siswa dari ujian ke ujian. Identifikasi tren positif maupun area yang butuh intervensi.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i data-lucide="bell-ring" style="width:28px;"></i></div>
                <h3>Smart Alert</h3>
                <p>Notifikasi otomatis untuk siswa yang nilainya di bawah KKM. Kelompokkan berdasarkan topik untuk remedial tepat sasaran.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i data-lucide="git-branch" style="width:28px;"></i></div>
                <h3>Auto Mapping</h3>
                <p>Parser cerdas yang secara otomatis menghubungkan kategori soal Moodle ke dalam hierarki kompetensi Anda.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i data-lucide="bar-chart-3" style="width:28px;"></i></div>
                <h3>Subject Heatmap</h3>
                <p>Dashboard makro untuk Kepala Sekolah: lihat performa per mata pelajaran dan excellent rate dalam satu layar.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i data-lucide="award" style="width:28px;"></i></div>
                <h3>Gamification</h3>
                <p>Berikan badge otomatis untuk Growth Hat-trick dan pencapaian Excellent. Motivasi siswa melalui penghargaan digital.</p>
            </div>
        </div>
    </div>
</section>

<!-- ECOSYSTEM -->
<section class="ecosystem container" id="ecosystem">
    <div class="section-label">— Ekosistem Masa Depan</div>
    <h2 class="section-title">Future Ecosystem</h2>
    <p class="section-sub" style="margin-bottom:4rem;">Terintegrasi penuh dengan ekosistem pembelajaran digital Anda.</p>
    <div class="eco-grid">
        <div class="eco-card lms">
            <div class="icon-wrap"><i data-lucide="book-open" style="width:32px;"></i></div>
            <h3>LMS Integration</h3>
            <p>Top Exam terhubung langsung dengan LMS Moodle Anda. Tidak perlu migrasi data — kami membaca database Moodle secara read-only dan aman.</p>
            <ul>
                <li><i data-lucide="check-circle"></i> Single Sign-On dengan akun Moodle</li>
                <li><i data-lucide="check-circle"></i> Sinkronisasi kuis & tryout real-time</li>
                <li><i data-lucide="check-circle"></i> Struktur kelas & enrollment otomatis</li>
                <li><i data-lucide="check-circle"></i> Private cloud atau on-premise deployment</li>
            </ul>
        </div>
        <div class="eco-card ai">
            <div class="icon-wrap"><i data-lucide="cpu" style="width:32px;"></i></div>
            <h3>AI Robot Assistant</h3>
            <p>Asisten AI yang siap membantu analisis, rekomendasi, dan laporan otomatis untuk guru dan kepala sekolah.</p>
            <ul>
                <li><i data-lucide="check-circle"></i> Rekomendasi remedial berbasis data</li>
                <li><i data-lucide="check-circle"></i> Laporan perkembangan siswa otomatis</li>
                <li><i data-lucide="check-circle"></i> Analisis prediktif performa ujian</li>
                <li><i data-lucide="check-circle"></i> Narasi raport otomatis per kompetensi</li>
            </ul>
        </div>
    </div>
</section>

<!-- CTA -->
<div style="text-align:center; padding:4rem 2rem 6rem; background:linear-gradient(135deg,#f8fafc,#fff);">
    <h2 style="font-size:2.2rem;font-weight:800;margin-bottom:1rem;">Siap bertransformasi?</h2>
    <p style="color:#64748b;max-width:500px;margin:0 auto 2.5rem;font-size:1.05rem;">Jadwalkan demo langsung dengan tim kami dan lihat bagaimana platform ini bisa merevolusi cara sekolah Anda mengevaluasi kompetensi siswa.</p>
    <a href="/demo" class="btn-primary"><i data-lucide="calendar" style="width:20px;"></i> Jadwalkan Demo</a>
</div>

<footer>
    <a href="/" class="logo">
        <div class="logo-icon"><i data-lucide="graduation-cap" style="width:18px;"></i></div>
        Top Exam
    </a>
    <p>&copy; 2026 Top Exam — AI Learning Architecture. All rights reserved.</p>
</footer>

<script>lucide.createIcons();</script>
</body>
</html>
