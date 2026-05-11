<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | AI Learning Competency Mapping</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://unpkg.com/@lucide/icons"></script>
    <style>
        body {
            background: linear-gradient(135deg, #f8fafc 0%, #e0e7ff 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            overflow: hidden;
        }
        .login-card {
            width: 100%;
            max-width: 450px;
            padding: 3rem;
            border-radius: var(--radius-xl);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }
        .input-group {
            margin-bottom: 1.5rem;
        }
        .input-group label {
            display: block;
            font-size: 0.875rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--text-title);
        }
        .input-group input {
            width: 100%;
            padding: 0.875rem 1.25rem;
            border-radius: 1rem;
            border: 1px solid var(--border);
            background: #f8fafc;
            font-family: inherit;
            transition: var(--transition);
        }
        .input-group input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
            background: white;
        }
    </style>
</head>
<body>
    <div class="login-card glass">
        <div style="text-align: center; margin-bottom: 2.5rem;">
            <h1 style="font-size: 1.75rem; font-weight: 800; color: var(--primary); letter-spacing: -0.05em; margin-bottom: 0.5rem;">AI LEARNING</h1>
            <p class="text-sm text-slate-500">Selamat datang di Sistem Pemetaan Kompetensi. Masuk untuk melanjutkan.</p>
        </div>

        <form action="/login" method="POST">
            <div class="input-group">
                <label for="username">Username / NISN</label>
                <input type="text" id="username" name="username" placeholder="Masukkan username Anda" required>
            </div>

            <div class="input-group">
                <label for="password">Kata Sandi</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required>
            </div>

            <div class="input-group">
                <label for="token">Token Ujian (Opsional)</label>
                <input type="text" id="token" name="token" placeholder="X72-ABCD-99" style="text-transform: uppercase; font-family: monospace; letter-spacing: 0.1em;">
                <p class="text-xs text-slate-500" style="margin-top: 0.5rem;">Masukkan token jika Anda akan mengikuti sesi ujian.</p>
            </div>

            <button type="submit" class="btn-indigo" style="width: 100%; padding: 1rem; margin-top: 1rem; font-size: 1rem;">
                Masuk Ke Sistem
            </button>
        </form>

        <div style="margin-top: 2rem; text-align: center; border-top: 1px solid rgba(0,0,0,0.05); padding-top: 1.5rem;">
            <p class="text-xs text-slate-500">Butuh bantuan akses? <a href="#" style="color: var(--primary); font-weight: 700; text-decoration: none;">Hubungi Administrator Sekolah</a></p>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
