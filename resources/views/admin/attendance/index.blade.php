<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Absensi | Admin Dashboard</title>
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
        .btn-primary {
            background: linear-gradient(135deg, #e30613, #b0050f);
            color: white;
            border: none;
            cursor: pointer;
            transition: 0.3s;
            display: inline-block;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(227, 6, 19, 0.3);
        }
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
                <li><a href="{{ route('admin.dashboard') }}"><i class="fas fa-th-large"></i> Dashboard</a></li>
                <li><a href="{{ route('admin.posts.index') }}"><i class="fas fa-bullhorn"></i> Kelola Konten</a></li>
                <li><a href="{{ route('admin.registrations.index') }}"><i class="fas fa-user-plus"></i> Pendaftar SPMB</a></li>
                <li><a href="#"><i class="fas fa-users"></i> Data Siswa</a></li>
                <li><a href="{{ route('admin.employees.index') }}"><i class="fas fa-chalkboard-teacher"></i> Kepegawaian & HR</a></li>
                <li><a href="{{ route('admin.finance.index') }}"><i class="fas fa-wallet"></i> Kas Keuangan</a></li>
                <li><a href="{{ route('admin.spp.index') }}"><i class="fas fa-file-invoice-dollar"></i> Manajemen SPP</a></li>
                <li><a href="{{ route('admin.attendance.index') }}" class="active"><i class="fas fa-qrcode"></i> Sistem Absensi</a></li>
                <li><a href="{{ route('admin.inventory.index') }}"><i class="fas fa-boxes"></i> Inventaris & Gudang</a></li>
                <li><a href="#"><i class="fas fa-cog"></i> Pengaturan</a></li>
                <li style="margin-top: 50px;"><a href="{{ url('/') }}"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
        </nav>
    </div>
    <div class="main">
        <div class="header">
            <div>
                <h1 style="margin: 0;">Sistem Absensi Kehadiran</h1>
                <p style="color: #888; margin: 5px 0 0;">Generate QR Code per Mata Pelajaran</p>
            </div>
            <div style="background: white; padding: 10px 20px; border-radius: 50px; box-shadow: 0 5px 15px rgba(0,0,0,0.02);">
                <i class="far fa-calendar-alt"></i> {{ date('d F Y') }}
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr; gap: 30px;">
            <div class="panel">
                <h3>Daftar Mata Pelajaran (Generate QR Code)</h3>
                <table>
                    <thead>
                        <tr>
                            <th>KODE</th>
                            <th>Mata Pelajaran</th>
                            <th>Guru / Instruktur</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subjects as $subject)
                        <tr>
                            <td><strong>{{ $subject->code }}</strong></td>
                            <td>{{ $subject->name }}</td>
                            <td>{{ $subject->teacher_name }}</td>
                            <td>
                                <a href="{{ route('admin.attendance.qr', $subject->id) }}" class="btn-primary" style="padding: 8px 15px; font-size: 0.8rem; border-radius: 8px; text-decoration: none;">
                                    <i class="fas fa-qrcode"></i> Buka QR Kelas
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="panel">
                <h3>Data Absensi Terbaru (Hari Ini)</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Waktu Scan</th>
                            <th>Nama Siswa</th>
                            <th>NIS</th>
                            <th>Mata Pelajaran</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentAttendances as $attendance)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($attendance->scanned_at)->format('H:i:s') }} WIB</td>
                            <td><strong>{{ optional($attendance->student)->name ?? 'Siswa Terhapus' }}</strong></td>
                            <td>{{ optional($attendance->student)->nis ?? '-' }}</td>
                            <td>{{ $attendance->subject->name }}</td>
                            <td><span class="badge badge-success">Hadir</span></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="text-align: center; color: #888; padding: 30px 0;">Belum ada absensi hari ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
