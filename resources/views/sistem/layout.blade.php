<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} | SMK Ala Delphi</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --red: #e30613;
            --dark: #1a1a1a;
            --gray: #f4f4f4;
        }
        body {
            font-family: 'Outfit', sans-serif;
            margin: 0;
            display: flex;
            background: var(--gray);
        }
        .sidebar {
            width: 280px;
            height: 100vh;
            background: var(--dark);
            color: white;
            padding: 30px;
            position: fixed;
        }
        .sidebar h2 {
            font-size: 1.2rem;
            margin-bottom: 40px;
            color: var(--red);
        }
        .sidebar nav ul {
            list-style: none;
            padding: 0;
        }
        .sidebar nav ul li {
            margin-bottom: 15px;
        }
        .sidebar nav ul li a {
            color: #ccc;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            border-radius: 8px;
            transition: 0.3s;
        }
        .sidebar nav ul li a:hover, .sidebar nav ul li a.active {
            background: var(--red);
            color: white;
        }
        .main-content {
            margin-left: 280px;
            padding: 50px;
            width: calc(100% - 280px);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 50px;
        }
        .header h1 {
            font-size: 2rem;
            margin: 0;
        }
        .card {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            text-align: center;
        }
        .card i {
            font-size: 4rem;
            color: var(--red);
            margin-bottom: 20px;
        }
        .btn-back {
            display: inline-block;
            margin-top: 30px;
            padding: 12px 30px;
            background: var(--dark);
            color: white;
            text-decoration: none;
            border-radius: 50px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>SMK ALA DELPHI</h2>
        <nav>
            <ul>
                <li><a href="{{ url('/') }}"><i class="fas fa-home"></i> Beranda Utama</a></li>
                <li><a href="{{ route('sistem.ppdb') }}" class="{{ $title == 'PPDB Online' ? 'active' : '' }}"><i class="fas fa-user-plus"></i> PPDB Online</a></li>
                <li><a href="{{ route('sistem.akademik') }}" class="{{ $title == 'Sistem Akademik & E-Rapor' ? 'active' : '' }}"><i class="fas fa-book-reader"></i> Akademik</a></li>
                <li><a href="{{ route('sistem.keuangan') }}" class="{{ $title == 'Sistem Keuangan & SPP' ? 'active' : '' }}"><i class="fas fa-wallet"></i> Keuangan</a></li>
                <li><a href="{{ route('sistem.hrd') }}" class="{{ $title == 'SDM & Manajemen HR' ? 'active' : '' }}"><i class="fas fa-users-cog"></i> SDM / HRD</a></li>
                <li><a href="{{ route('sistem.inventaris') }}" class="{{ $title == 'Inventaris & Gudang' ? 'active' : '' }}"><i class="fas fa-boxes"></i> Inventaris</a></li>
            </ul>
        </nav>
    </div>
    <div class="main-content">
        <div class="header">
            <h1>{{ $title }}</h1>
            <div class="user-info">
                <span>Admin | <i class="fas fa-user-circle"></i></span>
            </div>
        </div>
        <div class="card">
            <i class="fas {{ $icon }}"></i>
            <h2>Dashboard {{ $title }}</h2>
            <p>Sistem sedang dalam tahap pengembangan untuk integrasi fitur penuh.</p>
            <p>Silakan hubungi tim IT SMK Ala Delphi untuk akses modul spesifik.</p>
            <a href="{{ url('/') }}" class="btn-back">Kembali ke Beranda</a>
        </div>
    </div>
</body>
</html>
