<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Absensi | SMKS Aladelphi</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --red: #e30613; --dark: #1a1a1a; --light: #f4f6f9; }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Outfit', sans-serif; background: var(--light); display: flex; min-height: 100vh; }

        /* Sidebar */
        .sidebar { width: 260px; background: var(--dark); color: white; padding: 25px 15px; position: fixed; height: 100vh; overflow-y: auto; }
        .sidebar-logo { display: flex; align-items: center; gap: 10px; margin-bottom: 40px; padding: 0 10px; }
        .sidebar-logo img { height: 38px; }
        .sidebar-logo span { font-size: 1.1rem; font-weight: 700; }
        .sidebar nav a { display: flex; align-items: center; gap: 12px; color: #aaa; text-decoration: none; padding: 11px 15px; border-radius: 10px; margin-bottom: 4px; font-size: 0.9rem; transition: 0.2s; }
        .sidebar nav a:hover, .sidebar nav a.active { background: rgba(227,6,19,0.15); color: #fff; font-weight: 600; }
        .sidebar nav a i { width: 18px; text-align: center; }

        /* Main */
        .main { margin-left: 260px; padding: 35px; width: 100%; }
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .page-header h1 { font-size: 1.6rem; font-weight: 800; color: var(--dark); }
        .page-header p { color: #888; font-size: 0.9rem; margin-top: 3px; }
        .date-badge { background: white; padding: 8px 18px; border-radius: 50px; font-size: 0.85rem; color: #555; box-shadow: 0 2px 10px rgba(0,0,0,0.06); }

        /* Stats */
        .stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: white; padding: 20px 25px; border-radius: 16px; box-shadow: 0 2px 10px rgba(0,0,0,0.04); display: flex; align-items: center; gap: 15px; }
        .stat-icon { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; }
        .stat-icon.red { background: rgba(227,6,19,0.1); color: var(--red); }
        .stat-icon.blue { background: rgba(59,130,246,0.1); color: #3b82f6; }
        .stat-icon.green { background: rgba(16,185,129,0.1); color: #10b981; }
        .stat-card h3 { font-size: 1.6rem; font-weight: 800; }
        .stat-card p { font-size: 0.8rem; color: #888; }

        /* Class Section */
        .class-section { margin-bottom: 30px; }
        .class-header { display: flex; align-items: center; gap: 12px; margin-bottom: 15px; padding: 12px 20px; background: white; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.04); }
        .class-badge { background: var(--red); color: white; padding: 4px 14px; border-radius: 50px; font-size: 0.8rem; font-weight: 700; }
        .class-header h2 { font-size: 1rem; font-weight: 700; color: var(--dark); }

        /* Subject Cards */
        .subject-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 16px; }
        .subject-card { background: white; border-radius: 16px; padding: 22px; box-shadow: 0 2px 10px rgba(0,0,0,0.04); border-left: 4px solid var(--red); transition: 0.3s; }
        .subject-card:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(0,0,0,0.1); }
        .subject-card .code { font-size: 0.7rem; font-weight: 700; color: var(--red); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; }
        .subject-card h3 { font-size: 1rem; font-weight: 700; color: var(--dark); margin-bottom: 6px; }
        .subject-card .teacher { font-size: 0.82rem; color: #666; display: flex; align-items: center; gap: 6px; margin-bottom: 4px; }
        .subject-card .president { font-size: 0.82rem; color: #666; display: flex; align-items: center; gap: 6px; margin-bottom: 15px; }
        .subject-card .btn-detail { display: block; text-align: center; background: linear-gradient(135deg, #e30613, #b0050f); color: white; padding: 10px; border-radius: 10px; text-decoration: none; font-weight: 700; font-size: 0.85rem; transition: 0.3s; }
        .subject-card .btn-detail:hover { opacity: 0.85; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-logo">
            <img src="{{ asset('images/official_logo.png') }}" alt="Logo">
            <span>ADMIN PANEL</span>
        </div>
        <nav>
            <a href="{{ route('admin.dashboard') }}"><i class="fas fa-th-large"></i> Dashboard</a>
            <a href="{{ route('admin.posts.index') }}"><i class="fas fa-bullhorn"></i> Kelola Konten</a>
            <a href="{{ route('admin.registrations.index') }}"><i class="fas fa-user-plus"></i> Pendaftar SPMB</a>
            <a href="{{ route('admin.employees.index') }}"><i class="fas fa-chalkboard-teacher"></i> Kepegawaian</a>
            <a href="{{ route('admin.finance.index') }}"><i class="fas fa-wallet"></i> Keuangan</a>
            <a href="{{ route('admin.spp.index') }}"><i class="fas fa-file-invoice-dollar"></i> SPP</a>
            <a href="{{ route('admin.attendance.index') }}" class="active"><i class="fas fa-qrcode"></i> Sistem Absensi</a>
            <a href="{{ route('admin.inventory.index') }}"><i class="fas fa-boxes"></i> Inventaris</a>
        </nav>
    </div>

    <div class="main">
        <div class="page-header">
            <div>
                <h1><i class="fas fa-qrcode" style="color: var(--red);"></i> Sistem Absensi</h1>
                <p>Kelola absensi siswa berdasarkan mata pelajaran & kelas</p>
            </div>
            <div class="date-badge"><i class="far fa-calendar-alt"></i> {{ date('d F Y') }}</div>
        </div>

        <!-- Stats -->
        <div class="stats">
            <div class="stat-card">
                <div class="stat-icon red"><i class="fas fa-book"></i></div>
                <div>
                    <h3>{{ $subjectsByClass->flatten()->count() }}</h3>
                    <p>Total Mata Pelajaran</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon blue"><i class="fas fa-users"></i></div>
                <div>
                    <h3>{{ $subjectsByClass->count() }}</h3>
                    <p>Total Kelas</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon green"><i class="fas fa-check-circle"></i></div>
                <div>
                    <h3>{{ $totalAttendances }}</h3>
                    <p>Absensi Hari Ini</p>
                </div>
            </div>
        </div>

        <!-- Subjects by Class -->
        @foreach($subjectsByClass as $className => $subjects)
        <div class="class-section">
            <div class="class-header">
                <span class="class-badge"><i class="fas fa-door-open"></i> KELAS</span>
                <h2>{{ $className }}</h2>
                <span style="color:#888; font-size:0.8rem;">{{ $subjects->count() }} Mata Pelajaran</span>
            </div>
            <div class="subject-grid">
                @foreach($subjects as $subject)
                <div class="subject-card">
                    <div class="code"><i class="fas fa-tag"></i> {{ $subject->code }}</div>
                    <h3>{{ $subject->name }}</h3>
                    <p class="teacher"><i class="fas fa-chalkboard-teacher"></i> {{ $subject->teacher_name ?? '-' }}</p>
                    <p class="president"><i class="fas fa-user-tie"></i> Ketua: {{ $subject->class_president ?? '-' }}</p>
                    <a href="{{ route('admin.attendance.detail', $subject->id) }}" class="btn-detail">
                        <i class="fas fa-clipboard-list"></i> Lihat Detail & Absensi
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</body>
</html>
