<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Manager — @yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: #f4f6fb; }
        .sidebar {
            width: 240px; min-height: 100vh;
            background: #1a1a2e; color: #fff;
            position: fixed; top: 0; left: 0;
            padding: 0;
        }
        .sidebar .brand {
            padding: 24px 20px 16px;
            font-size: 1.3rem; font-weight: 700;
            border-bottom: 1px solid #ffffff18;
            letter-spacing: 1px;
        }
        .sidebar .brand span { color: #e94560; }
        .sidebar .nav-link {
            color: #ffffffaa; padding: 12px 24px;
            display: flex; align-items: center; gap: 10px;
            transition: all 0.2s;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: #fff; background: #e9456018;
            border-left: 3px solid #e94560;
        }
        .sidebar .nav-link i { font-size: 1.1rem; }
        .main-content { margin-left: 240px; padding: 30px; }
        .topbar {
            background: #fff; padding: 14px 24px;
            border-radius: 12px; margin-bottom: 24px;
            display: flex; justify-content: space-between;
            align-items: center; box-shadow: 0 2px 8px #0001;
        }
        .topbar .user-info { font-weight: 600; color: #1a1a2e; }
        .card { border: none; border-radius: 14px; box-shadow: 0 2px 10px #0001; }
        .stat-card { background: linear-gradient(135deg, #e94560, #c73652); color: #fff; }
        .stat-card.blue { background: linear-gradient(135deg, #0f3460, #16213e); }
        .btn-primary { background: #e94560; border-color: #e94560; }
        .btn-primary:hover { background: #c73652; border-color: #c73652; }
        .badge-category {
            background: #e9456015; color: #e94560;
            padding: 4px 10px; border-radius: 20px; font-size: 0.8rem;
        }
        .table th { color: #888; font-size: 0.85rem; text-transform: uppercase; }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div class="brand">Product<span>Manager</span></div>
    <nav class="mt-3">
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid"></i> Dashboard
        </a>
        <a href="{{ route('products.index') }}" class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i> Products
        </a>
        <a href="{{ route('products.create') }}" class="nav-link">
            <i class="bi bi-plus-circle"></i> Add Product
        </a>
    </nav>

    <div style="position:absolute; bottom:0; width:100%; padding:16px 24px; border-top:1px solid #ffffff18;">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-sm w-100" style="background:#e9456020; color:#e94560;">
                <i class="bi bi-box-arrow-left"></i> Logout
            </button>
        </form>
    </div>
</div>

<!-- Main Content -->
<div class="main-content">
    <div class="topbar">
        <div>@yield('page-title', 'Dashboard')</div>
        <div class="user-info"><i class="bi bi-person-circle me-1"></i>{{ auth()->user()->name }}</div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>