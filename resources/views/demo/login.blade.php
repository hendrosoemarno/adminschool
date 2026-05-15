<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo | AI Learning Platform</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Outfit',sans-serif; }
        body { background:#0f172a; color:white; height:100vh; display:flex; overflow:hidden; }
        .container { width:100%; display:flex; }
        .left { flex:1.2; background:linear-gradient(135deg,rgba(79,70,229,0.2),#0f172a),url('/login_education_ai_bg_1778206885511.png'); background-size:cover; background-position:center; display:flex; flex-direction:column; justify-content:center; padding:5rem; position:relative; }
        .left::after { content:''; position:absolute; inset:0; background:radial-gradient(circle at center,transparent,#0f172a); }
        .brand { position:relative; z-index:10; }
        .logo { display:flex; align-items:center; gap:1rem; margin-bottom:2rem; }
        .logo-icon { width:50px; height:50px; background:#4f46e5; border-radius:12px; display:flex; align-items:center; justify-content:center; box-shadow:0 0 30px rgba(79,70,229,0.5); }
        .brand-name { font-size:2rem; font-weight:800; letter-spacing:-1px; }
        .tagline { font-size:3rem; font-weight:800; margin-bottom:1.5rem; line-height:1.1; }
        .tagline span { color:#818cf8; }
        .desc { font-size:1.25rem; color:#94a3b8; max-width:500px; line-height:1.6; }
        .right { flex:1; display:flex; align-items:center; justify-content:center; padding:2rem; }
        .card { width:100%; max-width:420px; padding:3rem; background:rgba(255,255,255,0.03); border:1px solid rgba(255,255,255,0.1); border-radius:32px; backdrop-filter:blur(20px); box-shadow:0 25px 50px -12px rgba(0,0,0,0.5); }
        .card h1 { font-size:1.75rem; font-weight:700; margin-bottom:0.5rem; }
        .card p { color:#94a3b8; font-size:0.9rem; margin-bottom:2.5rem; }
        .badge-demo { display:inline-flex; align-items:center; gap:0.5rem; background:rgba(5,150,105,0.15); color:#34d399; padding:0.4rem 1rem; border-radius:9999px; font-size:0.75rem; font-weight:700; margin-bottom:1.5rem; }
        .btn-demo { display:block; width:100%; padding:1rem; background:#059669; color:white; border:none; border-radius:16px; font-size:1rem; font-weight:700; cursor:pointer; text-decoration:none; text-align:center; transition:all 0.3s; }
        .btn-demo:hover { background:#10b981; transform:translateY(-2px); box-shadow:0 10px 20px -5px rgba(5,150,105,0.4); }
        .btn-outline { display:block; width:100%; padding:0.85rem; background:transparent; color:#94a3b8; border:1px solid rgba(255,255,255,0.1); border-radius:16px; font-size:0.9rem; font-weight:600; cursor:pointer; text-decoration:none; text-align:center; transition:all 0.3s; margin-top:1rem; }
        .btn-outline:hover { border-color:#4f46e5; color:white; }
        .divider { display:flex; align-items:center; gap:1rem; margin:1.5rem 0; }
        .divider-line { flex:1; height:1px; background:rgba(255,255,255,0.1); }
        .divider-text { color:#64748b; font-size:0.75rem; font-weight:600; text-transform:uppercase; }
        @media (max-width:1024px) { .left { display:none; } }
    </style>
</head>
<body>
<div class="container">
    <div class="left">
        <div class="brand">
            <div class="logo">
                <div class="logo-icon"><i data-lucide="brain-circuit" style="color:white;width:30px;height:30px;"></i></div>
                <span class="brand-name">AI Learning</span>
            </div>
            <div class="tagline">Coba <span>Platform</span> Sekarang.</div>
            <p class="desc">Jelajahi semua fitur dashboard analitik tanpa perlu koneksi database. Data dummy sudah siap.</p>
        </div>
    </div>
    <div class="right">
        <div class="card">
            <div class="badge-demo"><i data-lucide="presentation" style="width:16px;"></i> Mode Demo</div>
            <h1>Dashboard Kepala Sekolah</h1>
            <p>Akses langsung simulasi dashboard tanpa login. Ideal untuk presentasi dan evaluasi.</p>
            <a href="/demo/principal" class="btn-demo"><i data-lucide="eye" style="width:18px;vertical-align:middle;margin-right:0.5rem;"></i> Masuk Demo Sekarang</a>
            <div class="divider"><div class="divider-line"></div><span class="divider-text">atau</span><div class="divider-line"></div></div>
            <a href="/login" class="btn-outline"><i data-lucide="arrow-left" style="width:16px;vertical-align:middle;margin-right:0.5rem;"></i> Kembali ke Login Utama</a>
        </div>
    </div>
</div>
<script>lucide.createIcons();</script>
</body>
</html>
