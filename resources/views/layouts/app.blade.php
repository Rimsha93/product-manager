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
            display: flex; flex-direction: column;
        }
        .sidebar .brand {
            padding: 20px 20px 14px;
            font-size: 1.3rem; font-weight: 700;
            border-bottom: 1px solid #ffffff18;
            letter-spacing: 1px;
        }
        .sidebar .brand span { color: #e94560; }

        /* User Avatar Section */
        .sidebar .user-section {
            padding: 14px 20px;
            border-bottom: 1px solid #ffffff18;
            display: flex; align-items: center; gap: 10px;
        }
        .sidebar .avatar {
            width: 38px; height: 38px;
            background: #e94560;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 1rem; color: #fff;
            flex-shrink: 0;
        }
        .sidebar .user-info-text .user-name {
            font-size: 0.88rem; font-weight: 600; color: #fff;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
            max-width: 140px;
        }
        .sidebar .user-info-text .user-email {
            font-size: 0.73rem; color: #ffffff66;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
            max-width: 140px;
        }

        /* Search Box */
        .sidebar .search-box {
            padding: 12px 16px;
            border-bottom: 1px solid #ffffff18;
        }
        .sidebar .search-box input {
            width: 100%;
            background: #ffffff12;
            border: 1px solid #ffffff20;
            border-radius: 8px;
            padding: 7px 12px 7px 32px;
            color: #fff;
            font-size: 0.82rem;
            outline: none;
            transition: border 0.2s;
        }
        .sidebar .search-box input::placeholder { color: #ffffff55; }
        .sidebar .search-box input:focus { border-color: #e94560; }
        .sidebar .search-box .search-icon {
            position: absolute;
            left: 26px; top: 50%;
            transform: translateY(-50%);
            color: #ffffff55; font-size: 0.8rem;
        }
        .sidebar .search-wrapper { position: relative; }

        .sidebar nav { flex: 1; padding-top: 6px; }
        .sidebar .nav-label {
            padding: 10px 20px 4px;
            font-size: 0.68rem; text-transform: uppercase;
            letter-spacing: 1.5px; color: #ffffff44;
        }
        .sidebar .nav-link {
            color: #ffffffaa; padding: 10px 20px;
            display: flex; align-items: center; gap: 10px;
            transition: all 0.2s; font-size: 0.9rem;
            border-left: 3px solid transparent;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: #fff; background: #e9456018;
            border-left: 3px solid #e94560;
        }
        .sidebar .nav-link i { font-size: 1rem; width: 18px; }

        /* Bottom section */
        .sidebar .sidebar-bottom {
            padding: 12px 16px;
            border-top: 1px solid #ffffff18;
        }
        .sidebar .sidebar-bottom form button {
            width: 100%; background: #e9456020;
            color: #e94560; border: 1px solid #e9456040;
            border-radius: 8px; padding: 9px;
            font-size: 0.88rem; font-weight: 600;
            transition: all 0.2s; cursor: pointer;
        }
        .sidebar .sidebar-bottom form button:hover {
            background: #e94560; color: #fff;
        }

        .main-content { margin-left: 240px; padding: 28px; }
        .topbar {
            background: #fff; padding: 14px 22px;
            border-radius: 12px; margin-bottom: 22px;
            display: flex; justify-content: space-between;
            align-items: center; box-shadow: 0 2px 8px #0001;
        }
        .topbar .page-title { font-weight: 700; color: #1a1a2e; font-size: 1.05rem; }
        .topbar .topbar-right { display: flex; align-items: center; gap: 10px; }
        .topbar .topbar-avatar {
            width: 34px; height: 34px; background: #e94560;
            border-radius: 50%; display: flex; align-items: center;
            justify-content: center; color: #fff; font-weight: 700; font-size: 0.9rem;
        }
        .topbar .topbar-name { font-weight: 600; color: #1a1a2e; font-size: 0.92rem; }

        .card { border: none; border-radius: 14px; box-shadow: 0 2px 10px #0001; }
        .stat-card { color: #fff; }
        .stat-card.red   { background: linear-gradient(135deg, #e94560, #c73652); }
        .stat-card.blue  { background: linear-gradient(135deg, #0f3460, #16213e); }
        .stat-card.orange{ background: linear-gradient(135deg, #f4831f, #d4660a); }
        .stat-card.green { background: linear-gradient(135deg, #11998e, #38ef7d); }

        .badge-category {
            background: #e9456015; color: #e94560;
            padding: 3px 10px; border-radius: 20px; font-size: 0.78rem;
        }
        .table th { color: #888; font-size: 0.8rem; text-transform: uppercase; letter-spacing: .5px; }
        .alert-warning { border-radius: 10px; border: none; background: #fff8e1; }
    </style>
</head>
<body>

<!-- ===== SIDEBAR ===== -->
<div class="sidebar">

    <!-- Brand -->
    <div class="brand">Product<span>Manager</span></div>

    <!-- User Avatar + Info -->
    <div class="user-section">
        <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
        <div class="user-info-text">
            <div class="user-name">{{ auth()->user()->name }}</div>
            <div class="user-email">{{ auth()->user()->email }}</div>
        </div>
    </div>

    <!-- Search Box -->
    <div class="search-box">
        <form action="{{ route('products.index') }}" method="GET">
            <div class="search-wrapper">
                <i class="bi bi-search search-icon"></i>
                <input type="text" name="search" placeholder="Search products..."
                    value="{{ request('search') }}">
            </div>
        </form>
    </div>

    <!-- Navigation -->
    <nav>
        <div class="nav-label">Main</div>
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid"></i> Dashboard
        </a>
        <a href="{{ route('products.index') }}" class="nav-link {{ request()->routeIs('products.index') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i> Products
        </a>
        <a href="{{ route('products.create') }}" class="nav-link {{ request()->routeIs('products.create') ? 'active' : '' }}">
            <i class="bi bi-plus-circle"></i> Add Product
        </a>

        <div class="nav-label mt-2">Account</div>
        <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
            <i class="bi bi-person-circle"></i> Profile
        </a>
        <a href="{{ route('settings') }}" class="nav-link {{ request()->routeIs('settings') ? 'active' : '' }}">
            <i class="bi bi-gear"></i> Settings
        </a>
    </nav>

    <!-- Logout -->
    <div class="sidebar-bottom">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">
                <i class="bi bi-box-arrow-left me-2"></i>Logout
            </button>
        </form>
    </div>
</div>

<!-- ===== MAIN CONTENT ===== -->
<div class="main-content">

    <!-- Topbar -->
    <div class="topbar">
        <div class="page-title">@yield('page-title', 'Dashboard')</div>
        <div class="topbar-right">
            <div class="topbar-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <span class="topbar-name">{{ auth()->user()->name }}</span>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 mb-3" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>