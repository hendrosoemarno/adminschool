<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Exam — Pemetaan Diagnostik & Ekosistem Sekolah Masa Depan</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Inter',sans-serif; background:#fff; color:#0a1a2f; overflow-x:hidden; }
        .container { max-width:1200px; margin:0 auto; padding:0 2rem; }

        nav { display:flex; justify-content:space-between; align-items:center; padding:1.5rem 2rem; max-width:1200px; margin:0 auto; }
        .logo { display:flex; align-items:center; gap:0.75rem; font-weight:800; font-size:1.5rem; color:#0a1a2f; text-decoration:none; }
        .logo-icon { width:42px; height:42px; background:linear-gradient(135deg,#059669,#0a1a2f); border-radius:12px; display:flex; align-items:center; justify-content:center; color:#fff; }
        .nav-cta { background:#059669; color:#fff !important; padding:0.6rem 1.5rem; border-radius:999px; font-weight:700; text-decoration:none; font-size:0.9rem; transition:all 0.3s; }
        .nav-cta:hover { background:#047857; transform:translateY(-1px); }

        .btn-primary { background:#059669; color:#fff; padding:1rem 2.5rem; border-radius:999px; font-weight:700; text-decoration:none; font-size:1rem; transition:all 0.3s; display:inline-flex; align-items:center; gap:0.5rem; }
        .btn-primary:hover { background:#047857; transform:translateY(-2px); box-shadow:0 10px 30px -5px rgba(5,150,105,0.3); }
        .btn-outline { border:2px solid #e2e8f0; color:#0a1a2f; padding:1rem 2.5rem; border-radius:999px; font-weight:700; text-decoration:none; font-size:1rem; transition:all 0.3s; display:inline-flex; align-items:center; gap:0.5rem; }
        .btn-outline:hover { border-color:#059669; color:#059669; }
        .section-label { font-size:0.8rem; font-weight:700; color:#059669; text-transform:uppercase; letter-spacing:2px; text-align:center; margin-bottom:0.75rem; }
        .section-title { font-size:2.5rem; font-weight:800; text-align:center; margin-bottom:1rem; line-height:1.2; }
        .section-sub { color:#64748b; text-align:center; max-width:680px; margin:0 auto 4rem; font-size:1.05rem; line-height:1.7; }

        /* HERO */
        .hero { padding:5rem 0 3rem; text-align:center; position:relative; }
        .hero-badge { display:inline-flex; align-items:center; gap:0.5rem; background:#05966910; color:#059669; padding:0.4rem 1rem; border-radius:999px; font-size:0.8rem; font-weight:700; margin-bottom:1.5rem; }
        .hero h1 { font-size:3.2rem; font-weight:900; line-height:1.15; letter-spacing:-1px; margin-bottom:1.5rem; max-width:850px; margin-left:auto; margin-right:auto; }
        .hero h1 span { background:linear-gradient(135deg,#059669,#0a1a2f); -webkit-background-clip:text; -webkit-text-fill-color:transparent; }
        .hero .subheadline { font-size:1.2rem; color:#64748b; max-width:650px; margin:0 auto 2.5rem; line-height:1.7; font-weight:400; }
        .hero-visual { margin-top:3rem; position:relative; height:300px; }
        .chart-bars { position:absolute; bottom:0; left:50%; transform:translateX(-50%); display:flex; align-items:flex-end; gap:14px; }
        .chart-bars .bar { width:32px; border-radius:6px 6px 0 0; background:linear-gradient(to top,rgba(5,150,105,0.7),rgba(5,150,105,0.15)); }
        .chart-bars .bar:nth-child(1) { height:60px; }
        .chart-bars .bar:nth-child(2) { height:110px; }
        .chart-bars .bar:nth-child(3) { height:160px; background:linear-gradient(to top,rgba(5,150,105,0.9),rgba(5,150,105,0.3)); }
        .chart-bars .bar:nth-child(4) { height:80px; }
        .chart-bars .bar:nth-child(5) { height:130px; }
        .hero-glow { position:absolute; width:500px; height:300px; border-radius:50%; background:radial-gradient(circle,rgba(5,150,105,0.06),transparent 70%); top:0; left:50%; transform:translateX(-50%); }

        /* PRODUK UTAMA */
        .product { padding:6rem 0; background:#f8fafc; }
        .product .feature-grid { display:grid; grid-template-columns:1fr 1fr; gap:3rem; align-items:center; }
        .product-left h3 { font-size:2rem; font-weight:800; margin-bottom:0.75rem; }
        .product-left .tagline { color:#059669; font-weight:700; font-size:1.1rem; margin-bottom:1rem; }
        .product-left p { color:#64748b; line-height:1.7; margin-bottom:2rem; }
        .group-card { background:#fff; border:1px solid #f1f5f9; border-radius:20px; padding:1.5rem; margin-bottom:1rem; transition:all 0.3s; }
        .group-card:hover { box-shadow:0 10px 30px -10px rgba(0,0,0,0.06); }
        .group-card h4 { display:flex; align-items:center; gap:0.75rem; font-size:1rem; font-weight:700; margin-bottom:0.5rem; }
        .group-card p { color:#64748b; font-size:0.9rem; margin:0; }
        .group-card .icon-juara { color:#059669; }
        .group-card .icon-remedial { color:#dc2626; }

        /* FUTURE PRODUCTS */
        .future { padding:6rem 0; }
        .future-grid { display:grid; grid-template-columns:1fr 1fr 1fr; gap:2rem; }
        .future-card { border-radius:24px; padding:2.5rem 2rem; border:1px solid #f1f5f9; transition:all 0.3s; background:#fff; }
        .future-card:hover { box-shadow:0 20px 40px -10px rgba(0,0,0,0.06); border-color:#e2e8f0; transform:translateY(-3px); }
        .future-card .icon-wrap { width:60px; height:60px; border-radius:16px; display:flex; align-items:center; justify-content:center; margin-bottom:1.25rem; }
        .future-card .icon-wrap.green { background:linear-gradient(135deg,rgba(5,150,105,0.1),rgba(5,150,105,0.05)); color:#059669; }
        .future-card .icon-wrap.navy { background:linear-gradient(135deg,rgba(10,26,47,0.08),rgba(10,26,47,0.03)); color:#0a1a2f; }
        .future-card .icon-wrap.gold { background:linear-gradient(135deg,rgba(245,158,11,0.1),rgba(245,158,11,0.05)); color:#d97706; }
        .future-card h3 { font-size:1.2rem; font-weight:700; margin-bottom:0.5rem; }
        .future-card .tagline { color:#059669; font-weight:600; font-size:0.9rem; margin-bottom:0.75rem; }
        .future-card p { color:#64748b; font-size:0.9rem; line-height:1.7; }

        /* SOCIAL PROOF */
        .trusted-section { padding:5rem 0; background:#f8fafc; text-align:center; position:relative; }
        .trusted-section h2 { font-size:2rem; font-weight:800; margin-bottom:1.5rem; }
        .trusted-section .highlight { background:linear-gradient(135deg,#059669,#0a1a2f); -webkit-background-clip:text; -webkit-text-fill-color:transparent; }
        .trusted-section .narasi { color:#64748b; max-width:760px; margin:0 auto 3rem; line-height:1.8; font-size:1.05rem; }
        .trusted-number { font-size:3rem; font-weight:900; color:#059669; }
        .trusted-label { color:#64748b; font-weight:600; font-size:0.9rem; max-width:180px; margin:0 auto; }
        .trusted-logos { display:flex; justify-content:center; gap:3rem; align-items:center; flex-wrap:wrap; }
        .trusted-logos span { font-size:1rem; font-weight:700; color:#94a3b8; opacity:0.5; }
        .map-visual { margin:3rem auto 0; max-width:600px; position:relative; }
        .map-image { width:100%; aspect-ratio:16/9; border-radius:20px; background:linear-gradient(135deg,#f1f5f9,#e2e8f0); border:1px solid #e2e8f0; display:flex; align-items:center; justify-content:center; overflow:hidden; position:relative; }
        .map-image .placeholder-icon { color:#94a3b8; text-align:center; }
        .map-image .placeholder-icon i { width:48px; height:48px; color:#cbd5e1; }
        .map-image .placeholder-icon p { font-size:0.9rem; color:#94a3b8; margin-top:0.75rem; font-weight:600; }
        .map-image .placeholder-icon span { font-size:0.8rem; color:#cbd5e1; display:block; margin-top:0.25rem; }
        .map-dots { display:flex; flex-wrap:wrap; justify-content:center; gap:1.5rem; margin-top:2rem; }
        .map-dot { display:flex; align-items:center; gap:0.5rem; font-size:0.85rem; color:#475569; }
        .map-dot i { color:#059669; width:16px; }

        /* WHATSAPP FLOATING */
        .wa-float { position:fixed; bottom:24px; right:24px; z-index:999; width:56px; height:56px; background:#25d366; border-radius:50%; display:flex; align-items:center; justify-content:center; color:#fff; box-shadow:0 4px 20px rgba(37,211,102,0.4); transition:all 0.3s; text-decoration:none; }
        .wa-float:hover { transform:scale(1.08); box-shadow:0 6px 30px rgba(37,211,102,0.5); }

        /* FOOTER */
        footer { background:#0a1a2f; color:#fff; padding:3rem 2rem; text-align:center; }
        footer .logo { color:#fff; justify-content:center; margin-bottom:1rem; }
        footer p { color:#64748b; font-size:0.85rem; }
        footer .siplah { margin-top:1rem; display:inline-flex; align-items:center; gap:0.5rem; background:rgba(255,255,255,0.05); padding:0.5rem 1.25rem; border-radius:999px; font-size:0.8rem; color:#94a3b8; }
        footer .siplah strong { color:#fff; }

        @media (max-width:900px) {
            .hero h1 { font-size:2rem; }
            .product .feature-grid { grid-template-columns:1fr; }
            .future-grid { grid-template-columns:1fr; }
        }
    </style>
</head>
<body>

<nav>
    <a href="/" class="logo"><div class="logo-icon"><i data-lucide="graduation-cap" style="width:22px;"></i></div>Top Exam</a>
    <a href="/login" class="nav-cta">Masuk</a>
</nav>

<!-- HERO -->
<section class="hero container">
    <div class="hero-badge"><i data-lucide="sparkles" style="width:16px;"></i> Platform Pemetaan Diagnostik</div>
    <h1>Ubah Data Nilai Menjadi<br><span>Strategi Kesuksesan Siswa.</span></h1>
    <p class="subheadline">Top Exam: Bukan Sekadar Try Out, Tapi Peta Jalan Menuju Prestasi.</p>
    <div style="display:flex; gap:1rem; justify-content:center; flex-wrap:wrap;">
        <a href="/demo" class="btn-primary"><i data-lucide="play-circle" style="width:20px;"></i> Lihat Demo Dashboard</a>
        <a href="#produk" class="btn-outline">Pelajari Lebih Lanjut</a>
    </div>
    <div class="hero-visual">
        <div class="hero-glow"></div>
        <div class="chart-bars">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
    </div>
</section>

<!-- PRODUK UTAMA -->
<section class="product" id="produk">
    <div class="container">
        <div class="section-label">— Produk Utama</div>
        <div class="feature-grid">
            <div class="product-left">
                <div class="tagline">Top Exam — Pemetaan Diagnostik</div>
                <h3>Berhenti Menebak-nebak,<br>Mulailah Memetakan.</h3>
                <p>Guru tidak perlu lagi menghitung manual. Biarkan AI kami yang bekerja mengelompokkan siswa Anda secara otomatis berdasarkan data ujian sesungguhnya.</p>
                <div class="group-card">
                    <h4><i data-lucide="trophy" class="icon-juara" style="width:20px;"></i> Kelompok Juara</h4>
                    <p>Siap dipacu untuk kompetisi dan target kelulusan tinggi.</p>
                </div>
                <div class="group-card">
                    <h4><i data-lucide="heart-handshake" class="icon-remedial" style="width:20px;"></i> Kelompok Remedial</h4>
                    <p>Terdeteksi otomatis di sub-materi mana mereka butuh bantuan — bukan sekadar "nilainya jelek".</p>
                </div>
            </div>
            <div style="display:flex; align-items:center; justify-content:center;">
                <div style="width:100%; max-width:480px; background:linear-gradient(135deg,#f8fafc,#fff); border:1px solid #f1f5f9; border-radius:28px; padding:2rem; box-shadow:0 20px 40px -10px rgba(0,0,0,0.05);">
                    <div style="display:flex; justify-content:space-between; margin-bottom:1.5rem;">
                        <span style="font-weight:700; font-size:0.9rem;">Peta Kompetensi Siswa</span>
                        <span style="font-size:0.75rem; color:#94a3b8;">Radar Chart</span>
                    </div>
                    <div style="display:flex; justify-content:center; gap:1rem; margin-bottom:1.5rem;">
                        <div style="width:12px; height:12px; border-radius:50%; background:#059669;"></div>
                        <div style="width:12px; height:12px; border-radius:50%; background:#4f46e5;"></div>
                        <div style="width:12px; height:12px; border-radius:50%; background:#d97706;"></div>
                    </div>
                    <svg viewBox="0 0 200 140" style="width:100%;">
                        <polygon points="100,10 180,50 150,130 50,130 20,50" fill="rgba(5,150,105,0.08)" stroke="rgba(5,150,105,0.3)" stroke-width="1"/>
                        <polygon points="100,30 160,60 140,110 60,110 40,60" fill="rgba(79,70,229,0.08)" stroke="rgba(79,70,229,0.3)" stroke-width="1"/>
                        <polygon points="100,50 140,70 130,90 70,90 60,70" fill="rgba(5,150,105,0.12)" stroke="#059669" stroke-width="1.5"/>
                        <circle cx="100" cy="50" r="3" fill="#059669"/>
                        <circle cx="140" cy="70" r="3" fill="#059669"/>
                        <circle cx="130" cy="90" r="3" fill="#059669"/>
                        <circle cx="70" cy="90" r="3" fill="#059669"/>
                        <circle cx="60" cy="70" r="3" fill="#059669"/>
                        <text x="100" y="8" text-anchor="middle" font-size="7" fill="#94a3b8">Matematika</text>
                        <text x="188" y="52" text-anchor="start" font-size="7" fill="#94a3b8">IPA</text>
                        <text x="155" y="138" text-anchor="middle" font-size="7" fill="#94a3b8">B. Indo</text>
                        <text x="45" y="138" text-anchor="middle" font-size="7" fill="#94a3b8">Inggris</text>
                        <text x="8" y="52" text-anchor="end" font-size="7" fill="#94a3b8">Agama</text>
                    </svg>
                    <div style="display:flex; justify-content:space-between; margin-top:1rem; font-size:0.75rem;">
                        <span style="color:#059669;">▲ Juara: 12 siswa</span>
                        <span style="color:#dc2626;">▼ Remedial: 8 siswa</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FUTURE PRODUCTS -->
<section class="future container">
    <div class="section-label">— Ekosistem Masa Depan</div>
    <h2 class="section-title">Visi Besar Ekosistem Digital<br>Sekolah Anda</h2>
    <p class="section-sub">Top Exam adalah bagian dari ekosistem besar AI Learning. Satu platform, solusi lengkap untuk sekolah masa depan.</p>
    <div class="future-grid">
        <div class="future-card">
            <div class="icon-wrap green"><i data-lucide="book-open" style="width:28px;"></i></div>
            <h3>Smart LMS</h3>
            <div class="tagline">Kelas Digital dalam Genggaman.</div>
            <p>Kelola materi, tugas, dan ujian tanpa kertas. Ringkas untuk Guru, seru untuk Siswa.</p>
        </div>
        <div class="future-card">
            <div class="icon-wrap navy"><i data-lucide="building" style="width:28px;"></i></div>
            <h3>Sistem Administrasi Sekolah</h3>
            <div class="tagline">Urusan Kantor Jadi Lebih Ringan.</div>
            <p>Kelola data absen, laporan BOS, hingga administrasi sekolah hanya dengan beberapa klik. Biarkan sistem yang membereskan kerumitan kertas kerja Anda.</p>
        </div>
        <div class="future-card">
            <div class="icon-wrap gold"><i data-lucide="bot" style="width:28px;"></i></div>
            <h3>AI Language Lab</h3>
            <div class="tagline">Robot Teman Ngobrol, Jago Bahasa Inggris & Arab.</div>
            <p>Inilah masa depan Lab Bahasa. Siswa berlatih bicara langsung dengan Robot AI yang pintar dan ramah. <strong>Tanpa Malu, Tanpa Ragu, Pasti Bisa.</strong></p>
        </div>
    </div>
</section>

<!-- SOCIAL PROOF -->
<section class="trusted-section">
    <div class="container">
        <div class="section-label">— Jangkauan & Kepercayaan</div>
        <h2><span class="highlight">Standar Global</span> untuk Masa Depan<br>Pendidikan Indonesia</h2>
        <p class="narasi">Lebih dari <strong>600 siswa</strong> telah mempercayakan pemetaan akademik mereka kepada kami. Dengan teknologi Top Exam, saat ini kami secara aktif mendampingi <strong>200+ siswa</strong> yang berasal dari <strong>220+ institusi pendidikan</strong> — mulai dari sekolah unggulan nasional hingga sekolah internasional. Kami hadir memberikan data pemetaan yang akurat, menjadi kompas bagi sekolah dan orang tua dalam menuntun masa depan siswa.</p>
        <div style="display:flex; justify-content:center; gap:4rem; flex-wrap:wrap; margin-bottom:2rem;">
            <div><div class="trusted-number">600+</div><div class="trusted-label">Total Siswa Terfasilitasi</div></div>
            <div><div class="trusted-number">200+</div><div class="trusted-label">Siswa Aktif Terpetakan</div></div>
            <div><div class="trusted-number">220+</div><div class="trusted-label">Asal Institusi Pendidikan<br><span style="font-size:0.75rem;color:#94a3b8;">Nasional & Internasional</span></div></div>
        </div>
        <div class="map-visual">
            <div class="map-image">
                <div class="placeholder-icon">
                    <i data-lucide="map"></i>
                    <p>Peta Sebaran Institusi</p>
                    <span>Letakkan gambar peta lokasi di sini (16:9)</span>
                </div>
            </div>
            <div class="map-dots">
                <span class="map-dot"><i data-lucide="map-pin"></i> Malang</span>
                <span class="map-dot"><i data-lucide="map-pin"></i> Surabaya</span>
                <span class="map-dot"><i data-lucide="map-pin"></i> Jakarta</span>
                <span class="map-dot"><i data-lucide="map-pin"></i> Balikpapan</span>
                <span class="map-dot"><i data-lucide="map-pin"></i> Palembang</span>
                <span class="map-dot"><i data-lucide="map-pin"></i> 🇯🇵 Jepang</span>
                <span class="map-dot"><i data-lucide="map-pin"></i> 🇸🇦 Jeddah</span>
            </div>
        </div>
        <p style="color:#059669;font-weight:700;font-size:0.85rem;margin-top:2rem;"><i data-lucide="globe" style="width:16px;vertical-align:middle;margin-right:0.5rem;"></i> Sistem pemetaan yang diakui secara global oleh siswa lintas negara.</p>
    </div>
</section>

<!-- CTA -->
<div style="text-align:center; padding:5rem 2rem; background:#fff;">
    <h2 style="font-size:2.2rem;font-weight:800;margin-bottom:1rem;">Siap bertransformasi?</h2>
    <p style="color:#64748b;max-width:500px;margin:0 auto 2.5rem;font-size:1.05rem;">Jadwalkan demo langsung dan lihat bagaimana platform ini bisa merevolusi cara sekolah Anda mengevaluasi kompetensi siswa.</p>
    <a href="/demo" class="btn-primary"><i data-lucide="calendar" style="width:20px;"></i> Jadwalkan Demo Sekarang</a>
</div>

<footer>
    <a href="/" class="logo"><div class="logo-icon"><i data-lucide="graduation-cap" style="width:18px;"></i></div>Top Exam</a>
    <p>&copy; 2026 Top Exam — AI Learning Architecture. All rights reserved.</p>
    <div class="siplah">
        <i data-lucide="shield-check" style="width:16px;"></i> Transaksi resmi & aman melalui <strong>SIPLah</strong>
    </div>
</footer>

<!-- WhatsApp Floating -->
<a href="https://wa.me/6281234567890?text=Halo%20saya%20tertarik%20dengan%20Top%20Exam" target="_blank" class="wa-float" aria-label="WhatsApp">
    <i data-lucide="message-circle" style="width:26px;"></i>
</a>

<script>lucide.createIcons();</script>
</body>
</html>
