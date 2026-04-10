<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login — Product Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #1a1a2e;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: #fff;
            border-radius: 16px;
            padding: 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        .brand-title {
            font-size: 1.8rem;
            font-weight: 800;
            color: #1a1a2e;
        }
        .brand-title span { color: #e94560; }
        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1.5px solid #e0e0e0;
            font-size: 0.95rem;
            transition: border-color 0.2s;
        }
        .form-control:focus {
            border-color: #e94560;
            box-shadow: 0 0 0 3px rgba(233,69,96,0.1);
        }
        .form-control.is-invalid {
            border-color: #dc3545;
        }
        .btn-login {
            background: #e94560;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-size: 1rem;
            font-weight: 600;
            width: 100%;
            transition: background 0.2s;
        }
        .btn-login:hover { background: #c73652; color: #fff; }
        .divider {
            text-align: center;
            color: #aaa;
            margin: 18px 0;
            position: relative;
        }
        .divider::before, .divider::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 42%;
            height: 1px;
            background: #e0e0e0;
        }
        .divider::before { left: 0; }
        .divider::after { right: 0; }
        .btn-register {
            background: transparent;
            color: #e94560;
            border: 1.5px solid #e94560;
            border-radius: 8px;
            padding: 11px;
            font-size: 1rem;
            font-weight: 600;
            width: 100%;
            transition: all 0.2s;
            text-decoration: none;
            display: block;
            text-align: center;
        }
        .btn-register:hover {
            background: #e94560;
            color: #fff;
        }
        .form-label {
            font-weight: 600;
            color: #333;
            font-size: 0.9rem;
        }
        .forgot-link {
            color: #e94560;
            font-size: 0.85rem;
            text-decoration: none;
        }
        .forgot-link:hover { text-decoration: underline; }
        .input-icon {
            position: relative;
        }
        .input-icon i {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="login-card">

        {{-- Brand --}}
        <div class="text-center mb-4">
            <div class="brand-title">Product<span>Manager</span></div>
            <p class="text-muted mt-1" style="font-size:0.9rem;">Apne account mein login karein</p>
        </div>

        {{-- Session Error --}}
        @if (session('status'))
            <div class="alert alert-success mb-3">{{ session('status') }}</div>
        @endif

        {{-- Login Form --}}
        <form method="POST" action="{{ route('login') }}" id="loginForm" novalidate>
            @csrf

            {{-- Email --}}
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <div class="input-icon">
                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}"
                        placeholder="example@email.com"
                        required
                        autocomplete="email"
                    >
                    <i class="bi bi-envelope"></i>
                </div>
                @error('email')
                    <div class="invalid-feedback d-block">
                        <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                    </div>
                @enderror
                <div class="invalid-feedback" id="emailError">
                    Valid email address daalen.
                </div>
            </div>

            {{-- Password --}}
            <div class="mb-2">
                <label for="password" class="form-label">Password</label>
                <div class="input-icon">
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="••••••••"
                        required
                        autocomplete="current-password"
                    >
                    <i class="bi bi-eye-slash" id="togglePassword"></i>
                </div>
                @error('password')
                    <div class="invalid-feedback d-block">
                        <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                    </div>
                @enderror
                <div class="invalid-feedback" id="passwordError">
                    Password daalna zaroori hai.
                </div>
            </div>

            {{-- Remember Me + Forgot Password --}}
            <div class="d-flex justify-content-between align-items-center mb-4 mt-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label text-muted" for="remember" style="font-size:0.88rem;">
                        Remember me
                    </label>
                </div>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-link">Forgot password?</a>
                @endif
            </div>

            {{-- Login Button --}}
            <button type="submit" class="btn-login mb-3">
                <i class="bi bi-box-arrow-in-right me-2"></i>Login
            </button>
        </form>

        {{-- Divider --}}
        <div class="divider">ya</div>

        {{-- Register Link --}}
        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="btn-register">
                <i class="bi bi-person-plus me-2"></i>Naya Account Banayein
            </a>
        @endif

    </div>

    <script>
        // Password toggle
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput  = document.getElementById('password');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });

        // Client-side validation
        document.getElementById('loginForm').addEventListener('submit', function (e) {
            let valid = true;

            const email    = document.getElementById('email');
            const password = document.getElementById('password');
            const emailErr = document.getElementById('emailError');
            const passErr  = document.getElementById('passwordError');

            // Reset
            email.classList.remove('is-invalid');
            password.classList.remove('is-invalid');

            // Email check
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!email.value.trim() || !emailRegex.test(email.value)) {
                email.classList.add('is-invalid');
                emailErr.style.display = 'block';
                valid = false;
            } else {
                emailErr.style.display = 'none';
            }

            // Password check
            if (!password.value.trim()) {
                password.classList.add('is-invalid');
                passErr.style.display = 'block';
                valid = false;
            } else {
                passErr.style.display = 'none';
            }

            if (!valid) e.preventDefault();
        });
    </script>
</body>
</html>