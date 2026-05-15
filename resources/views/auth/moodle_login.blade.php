<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | AI Learning Platform</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        :root {
            --primary: #4f46e5;
            --primary-light: #818cf8;
            --bg-dark: #0f172a;
            --glass: rgba(255, 255, 255, 0.03);
            --border: rgba(255, 255, 255, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background-color: var(--bg-dark);
            color: white;
            height: 100vh;
            display: flex;
            overflow: hidden;
        }

        .login-container {
            width: 100%;
            display: flex;
        }

        /* Left Side: Illustration */
        .illustration-side {
            flex: 1.2;
            background: linear-gradient(135deg, rgba(79, 70, 229, 0.2), rgba(15, 23, 42, 1)),
                        url('/login_education_ai_bg_1778206885511.png');
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 5rem;
            position: relative;
        }

        .illustration-side::after {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at center, transparent, var(--bg-dark));
        }

        .brand-content {
            position: relative;
            z-index: 10;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .logo-icon {
            width: 50px;
            height: 50px;
            background: var(--primary);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 30px rgba(79, 70, 229, 0.5);
        }

        .brand-name {
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: -1px;
        }

        .brand-desc {
            font-size: 1.25rem;
            color: #94a3b8;
            max-width: 500px;
            line-height: 1.6;
        }

        /* Right Side: Form */
        .form-side {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #0f172a;
            padding: 2rem;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            padding: 3rem;
            background: var(--glass);
            border: 1px solid var(--border);
            border-radius: 32px;
            backdrop-filter: blur(20px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .card-header {
            margin-bottom: 2.5rem;
        }

        .card-header h1 {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .card-header p {
            color: #94a3b8;
            font-size: 0.9rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-group label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: #94a3b8;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            width: 18px;
        }

        .input-wrapper input {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--border);
            border-radius: 16px;
            color: white;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .input-wrapper input:focus {
            outline: none;
            border-color: var(--primary);
            background: rgba(79, 70, 229, 0.1);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }

        .btn-login {
            width: 100%;
            padding: 1rem;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 16px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
        }

        .btn-login:hover {
            background: var(--primary-light);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(79, 70, 229, 0.4);
        }

        .error-badge {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #f87171;
            padding: 1rem;
            border-radius: 16px;
            margin-bottom: 2rem;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        @media (max-width: 1024px) {
            .illustration-side {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="login-container">
    <!-- Brand Section -->
    <div class="illustration-side">
        <div class="brand-content">
            <div class="brand-logo">
                <div class="logo-icon">
                    <i data-lucide="brain-circuit" style="color: white; width: 30px; height: 30px;"></i>
                </div>
                <span class="brand-name">AI Learning</span>
            </div>
            <h2 style="font-size: 3rem; font-weight: 800; margin-bottom: 1.5rem; line-height: 1.1;">
                Unlock Your <br><span style="color: var(--primary-light);">Academic Potential.</span>
            </h2>
            <p class="brand-desc">
                Platform pemetaan kompetensi berbasis AI yang terintegrasi langsung dengan ekosistem belajar Moodle Anda.
            </p>
        </div>
    </div>

    <!-- Login Section -->
    <div class="form-side">
        <div class="login-card">
            <div class="card-header">
                <h1>Selamat Datang</h1>
                <p>Silakan login menggunakan akun Moodle Anda.</p>
            </div>

            @if ($errors->any())
                <div class="error-badge">
                    <i data-lucide="alert-circle" style="width: 20px;"></i>
                    {{ $errors->first('login') }}
                </div>
            @endif

            <form action="{{ route('moodle.login.submit') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Username</label>
                    <div class="input-wrapper">
                        <i data-lucide="user"></i>
                        <input type="text" name="username" placeholder="Masukkan username" required autocomplete="off">
                    </div>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <div class="input-wrapper">
                        <i data-lucide="lock"></i>
                        <input type="password" name="password" placeholder="••••••••" required>
                    </div>
                </div>

                <button type="submit" class="btn-login">
                    Masuk Sekarang
                    <i data-lucide="arrow-right" style="width: 20px;"></i>
                </button>
            </form>

            <div style="margin-top: 2.5rem; text-align: center;">
                <p style="font-size: 0.8rem; color: #64748b;">
                    &copy; 2026 AI Learning Architecture. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    lucide.createIcons();
</script>
</body>
</html>
