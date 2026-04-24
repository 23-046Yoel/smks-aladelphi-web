<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | SMK Ala Delphi</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --red: #e30613;
            --dark: #1a1a1a;
            --light: #f8f9fa;
        }
        body {
            font-family: 'Outfit', sans-serif;
            margin: 0;
            display: flex;
            background: var(--light);
        }
        .sidebar {
            width: 260px;
            height: 100vh;
            background: var(--dark);
            color: white;
            padding: 30px 20px;
            position: fixed;
        }
        .sidebar-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 50px;
        }
        .sidebar-header img {
            height: 40px;
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
        }
        .sidebar nav ul li a:hover, .sidebar nav ul li a.active {
            background: rgba(227, 6, 19, 0.1);
            color: var(--red);
            font-weight: 600;
        }
        .main {
            margin-left: 260px;
            padding: 40px;
            width: 100%;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
            margin-bottom: 40px;
        }
        .stat-card {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.02);
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .stat-icon {
            width: 60px;
            height: 60px;
            background: rgba(227, 6, 19, 0.05);
            color: var(--red);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            font-size: 1.5rem;
        }
        .stat-data h4 {
            margin: 0;
            color: #888;
            font-size: 0.85rem;
        }
        .stat-data p {
            margin: 5px 0 0;
            font-size: 1.5rem;
            font-weight: 800;
        }
        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 25px;
        }
        .panel {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.02);
        }
        .panel h3 {
            margin-top: 0;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th {
            text-align: left;
            color: #888;
            padding-bottom: 15px;
        }
        td {
            padding: 15px 0;
            border-top: 1px solid #f8f8f8;
        }
        .badge {
            padding: 5px 12px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .badge-success { background: #e6f7ed; color: #28a745; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <img src="{{ asset('images/official_logo.png') }}" alt="Logo">
            <h3>ADMIN PANEL</h3>
        </div>
        <nav>
            <ul>
                <li><a href="{{ route('admin.dashboard') }}" class="active"><i class="fas fa-th-large"></i> Dashboard</a></li>
                <li><a href="{{ route('admin.posts.index') }}"><i class="fas fa-bullhorn"></i> Kelola Konten</a></li>
                <li><a href="{{ route('admin.registrations.index') }}"><i class="fas fa-user-plus"></i> Pendaftar SPMB</a></li>
                <li><a href="#"><i class="fas fa-users"></i> Data Siswa</a></li>
                <li><a href="{{ route('admin.employees.index') }}"><i class="fas fa-chalkboard-teacher"></i> Kepegawaian & HR</a></li>
                <li><a href="#"><i class="fas fa-wallet"></i> Keuangan</a></li>
                <li><a href="{{ route('admin.inventory.index') }}"><i class="fas fa-boxes"></i> Inventaris & Gudang</a></li>
                <li><a href="#"><i class="fas fa-cog"></i> Pengaturan</a></li>
                <li style="margin-top: 50px;"><a href="{{ url('/') }}"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
        </nav>
    </div>
    <div class="main">
        <div class="header">
            <div>
                <h1 style="margin: 0;">Dashboard Utama</h1>
                <p style="color: #888; margin: 5px 0 0;">Selamat datang kembali, Administrator</p>
            </div>
            <div style="background: white; padding: 10px 20px; border-radius: 50px; box-shadow: 0 5px 15px rgba(0,0,0,0.02);">
                <i class="far fa-calendar-alt"></i> 22 April 2026
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-user-graduate"></i></div>
                <div class="stat-data">
                    <h4>Total Siswa</h4>
                    <p>1,245</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-user-tie"></i></div>
                <div class="stat-data">
                    <h4>Total Guru</h4>
                    <p>54</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-file-invoice-dollar"></i></div>
                <div class="stat-data">
                    <h4>Pemasukan Hari Ini</h4>
                    <p>Rp 4.5M</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-user-plus"></i></div>
                <div class="stat-data">
                    <h4>Pendaftar PPDB</h4>
                    <p>128</p>
                </div>
            </div>
        </div>

        <div class="content-grid">
            <div class="panel">
                <h3>Aktivitas Terbaru</h3>
                <table>
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Aktivitas</th>
                            <th>Waktu</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Operator 1</td>
                            <td>Input nilai kelas X-RPL</td>
                            <td>10 Menit yang lalu</td>
                            <td><span class="badge badge-success">Berhasil</span></td>
                        </tr>
                        <tr>
                            <td>Admin Keuangan</td>
                            <td>Verifikasi SPP Budi S.</td>
                            <td>25 Menit yang lalu</td>
                            <td><span class="badge badge-success">Selesai</span></td>
                        </tr>
                        <tr>
                            <td>Guru Agama</td>
                            <td>Update modul pelajaran</td>
                            <td>1 Jam yang lalu</td>
                            <td><span class="badge badge-success">Aktif</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="panel">
                <h3>Agenda Sekolah</h3>
                <p>Ujian Akhir Semester - 10 Mei</p>
                <p>Rapat Guru & Staff - 15 Mei</p>
                <p>Wisuda Angkatan 2026 - 20 Juni</p>
            </div>
        </div>
    </div>
</body>
</html>
