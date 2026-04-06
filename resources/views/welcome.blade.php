<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center vh-100" style="background:#1a1a2e">
    <div class="text-center text-white">
        <h1 class="mb-2" style="font-size:3rem; font-weight:800;">
            Product<span style="color:#e94560;">Manager</span>
        </h1>
        <p class="mb-4" style="opacity:.7;">Apna inventory manage karo — easily!</p>

        @auth
            {{-- Agar already logged in hai toh dashboard button dikhao --}}
            <a href="{{ url('/dashboard') }}" class="btn btn-lg" style="background:#e94560; color:#fff;">
                Go to Dashboard
            </a>
        @else
            {{-- Agar logged in nahi toh Login aur Register dikhao --}}
            <a href="{{ route('login') }}" class="btn btn-lg me-2" style="background:#e94560; color:#fff;">
                Login
            </a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn btn-lg btn-outline-light">
                    Register
                </a>
            @endif
        @endauth
    </div>
</body>
</html>