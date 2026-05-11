<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') | SMK Ala Delphi</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --red: #e30613;
            --dark: #1a1a1a;
            --light: #f8f9fa;
            --sidebar-width: 260px;
        }
        
        * { box-sizing: border-box; }

        body {
            font-family: 'Outfit', sans-serif;
            margin: 0;
            display: flex;
            background: var(--light);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Sidebar Responsive */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--dark);
            color: white;
            padding: 30px 20px;
            position: fixed;
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .sidebar.collapsed {
            left: calc(-1 * var(--sidebar-width));
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 50px;
        }

        .sidebar-header img {
            height: 40px;
            width: auto;
        }

        .sidebar nav ul {
            list-style: none;
            padding: 0;
        }

        .sidebar nav ul li {
            margin-bottom: 8px;
        }

        .sidebar nav ul li a {
            color: #bbb;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            border-radius: 12px;
            transition: 0.3s;
            font-size: 0.9rem;
        }

        .sidebar nav ul li a:hover, .sidebar nav ul li a.active {
            background: rgba(227, 6, 19, 0.1);
            color: var(--red);
            font-weight: 600;
        }

        /* Main Content */
        .main {
            margin-left: var(--sidebar-width);
            padding: 30px;
            width: 100%;
            transition: all 0.3s ease;
        }

        .main.expanded {
            margin-left: 0;
        }

        .top-nav {
            display: none; /* Only visible on mobile */
            background: white;
            padding: 15px 20px;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 20px;
            border-radius: 12px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 20px;
        }

        /* Hamburger Button */
        .menu-toggle {
            display: none;
            background: var(--dark);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1.2rem;
        }

        /* Desktop Header Style */
        .desktop-header-info {
            background: white; 
            padding: 10px 20px; 
            border-radius: 50px; 
            box-shadow: 0 5px 15px rgba(0,0,0,0.02);
            font-size: 0.9rem;
        }

        /* Overlay for mobile */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 999;
        }

        /* Media Queries */
        @media (max-width: 992px) {
            .sidebar {
                left: calc(-1 * var(--sidebar-width));
            }
            .sidebar.active {
                left: 0;
            }
            .main {
                margin-left: 0;
                padding: 15px;
            }
            .top-nav {
                display: flex;
            }
            .header h1 {
                font-size: 1.5rem;
            }
            .menu-toggle {
                display: block;
            }
            .overlay.active {
                display: block;
            }
            .header {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        /* Utility Classes */
        .btn-action {
            padding: 12px 25px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            transition: 0.3s;
            font-size: 0.9rem;
        }
        
        @yield('extra_css')
    </style>
</head>
<body>
    <div class="overlay" id="overlay"></div>

    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <img src="{{ asset('images/official_logo.png') }}" alt="Logo" loading="lazy">
            <h3 style="font-size: 1.1rem; margin: 0;">ADMIN PANEL</h3>
        </div>
        <nav>
            <ul>
                <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="fas fa-th-large"></i> Dashboard</a></li>
                <li><a href="{{ route('admin.posts.index') }}" class="{{ request()->routeIs('admin.posts.*') ? 'active' : '' }}"><i class="fas fa-bullhorn"></i> Kelola Konten</a></li>
                <li><a href="{{ route('admin.registrations.index') }}" class="{{ request()->routeIs('admin.registrations.*') ? 'active' : '' }}"><i class="fas fa-user-plus"></i> Pendaftar SPMB</a></li>
                <li><a href="#"><i class="fas fa-users"></i> Data Siswa</a></li>
                <li><a href="{{ route('admin.employees.index') }}" class="{{ request()->routeIs('admin.employees.*') ? 'active' : '' }}"><i class="fas fa-chalkboard-teacher"></i> Kepegawaian & HR</a></li>
                <li><a href="{{ route('admin.finance.index') }}" class="{{ request()->routeIs('admin.finance.*') ? 'active' : '' }}"><i class="fas fa-wallet"></i> Kas Keuangan</a></li>
                <li><a href="{{ route('admin.spp.index') }}" class="{{ request()->routeIs('admin.spp.*') ? 'active' : '' }}"><i class="fas fa-file-invoice-dollar"></i> Manajemen SPP</a></li>
                <li><a href="{{ route('admin.attendance.index') }}" class="{{ request()->routeIs('admin.attendance.*') ? 'active' : '' }}"><i class="fas fa-qrcode"></i> Sistem Absensi</a></li>
                <li><a href="{{ route('admin.inventory.index') }}" class="{{ request()->routeIs('admin.inventory.*') ? 'active' : '' }}"><i class="fas fa-boxes"></i> Inventaris & Gudang</a></li>
                <li><a href="#"><i class="fas fa-cog"></i> Pengaturan</a></li>
                <li style="margin-top: 50px;"><a href="{{ url('/') }}"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
        </nav>
    </div>

    <div class="main">
        <div class="top-nav">
            <div style="display: flex; align-items: center; gap: 10px;">
                <img src="{{ asset('images/official_logo.png') }}" height="30" alt="Logo">
                <span style="font-weight: 800; font-size: 0.8rem;">ALA DELPHI</span>
            </div>
            <button class="menu-toggle" id="menuToggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <div class="header">
            <div>
                <h1 style="margin: 0;">@yield('header_title', 'Dashboard Utama')</h1>
                <p style="color: #888; margin: 5px 0 0;">@yield('header_subtitle', 'Selamat datang kembali, Administrator')</p>
            </div>
            <div class="desktop-header-info">
                <i class="far fa-calendar-alt"></i> {{ date('d F Y') }}
            </div>
        </div>

        @yield('content')
    </div>

    <script>
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        function toggleMenu() {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }

        menuToggle.addEventListener('click', toggleMenu);
        overlay.addEventListener('click', toggleMenu);
    </script>
    @yield('extra_js')
</body>
</html>
