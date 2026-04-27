<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Absensi - {{ $subject->name }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --red: #e30613; --dark: #1a1a1a; --light: #f4f6f9; }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Outfit', sans-serif; background: var(--light); }
        .container { max-width: 1200px; margin: 0 auto; padding: 30px 20px; }

        /* Header Card */
        .header-card { background: linear-gradient(135deg, #1a1a1a, #2d2d2d); color: white; padding: 30px 35px; border-radius: 20px; margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center; }
        .header-card h1 { font-size: 1.6rem; font-weight: 800; margin-bottom: 8px; }
        .header-card .info { display: flex; gap: 20px; flex-wrap: wrap; margin-top: 10px; }
        .info-item { display: flex; align-items: center; gap: 8px; font-size: 0.85rem; color: #ccc; }
        .info-item i { color: var(--red); }
        .btn-back { display: inline-flex; align-items: center; gap: 8px; background: rgba(255,255,255,0.1); color: white; padding: 10px 20px; border-radius: 10px; text-decoration: none; font-weight: 600; font-size: 0.85rem; transition: 0.2s; }
        .btn-back:hover { background: rgba(255,255,255,0.2); }

        /* Grid Layout */
        .grid { display: grid; grid-template-columns: 1fr 2fr; gap: 25px; }

        /* Panel */
        .panel { background: white; border-radius: 16px; padding: 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.04); }
        .panel h2 { font-size: 1rem; font-weight: 700; color: var(--dark); margin-bottom: 18px; padding-bottom: 12px; border-bottom: 2px solid #f0f0f0; display: flex; align-items: center; gap: 8px; }
        .panel h2 i { color: var(--red); }

        /* Student List */
        .student-item { display: flex; align-items: center; gap: 12px; padding: 10px 0; border-bottom: 1px solid #f8f8f8; }
        .student-avatar { width: 36px; height: 36px; background: linear-gradient(135deg, #e30613, #b0050f); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 0.85rem; flex-shrink: 0; }
        .student-info p { font-size: 0.88rem; font-weight: 600; color: var(--dark); }
        .student-info span { font-size: 0.75rem; color: #888; }
        .ketua-badge { background: #fef3c7; color: #d97706; padding: 2px 8px; border-radius: 50px; font-size: 0.7rem; font-weight: 700; margin-left: 5px; }

        /* Meetings Grid */
        .meetings-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; }
        .meeting-card { border: 2px solid #f0f0f0; border-radius: 12px; padding: 15px; text-align: center; transition: 0.3s; position: relative; }
        .meeting-card:hover { border-color: var(--red); transform: translateY(-2px); }
        .meeting-card .meeting-num { font-size: 1.2rem; font-weight: 800; color: var(--dark); }
        .meeting-card .meeting-label { font-size: 0.7rem; color: #888; margin-bottom: 8px; }
        .meeting-card .attendance-count { font-size: 0.75rem; color: #10b981; font-weight: 600; margin-bottom: 10px; }
        .meeting-card .attendance-count.zero { color: #ccc; }
        .btn-qr { display: block; background: linear-gradient(135deg, #e30613, #b0050f); color: white; padding: 7px 5px; border-radius: 8px; text-decoration: none; font-weight: 700; font-size: 0.72rem; transition: 0.2s; }
        .btn-qr:hover { opacity: 0.85; }
        .btn-qr i { display: block; font-size: 1.1rem; margin-bottom: 2px; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header-card">
            <div>
                <h1><i class="fas fa-book" style="color: var(--red);"></i> {{ $subject->name }}</h1>
                <div class="info">
                    <span class="info-item"><i class="fas fa-door-open"></i> Kelas {{ $subject->class_name }}</span>
                    <span class="info-item"><i class="fas fa-chalkboard-teacher"></i> {{ $subject->teacher_name }}</span>
                    <span class="info-item"><i class="fas fa-user-tie"></i> Ketua: {{ $subject->class_president }}</span>
                    <span class="info-item"><i class="fas fa-users"></i> {{ $students->count() }} Siswa</span>
                </div>
            </div>
            <a href="{{ route('admin.attendance.index') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="grid">
            <!-- Daftar Siswa -->
            <div class="panel">
                <h2><i class="fas fa-users"></i> Daftar Siswa ({{ $students->count() }})</h2>
                @forelse($students as $student)
                <div class="student-item">
                    <div class="student-avatar">{{ strtoupper(substr($student->name, 0, 1)) }}</div>
                    <div class="student-info">
                        <p>
                            {{ $student->name }}
                            @if($student->name == $subject->class_president)
                            <span class="ketua-badge"><i class="fas fa-crown"></i> Ketua</span>
                            @endif
                        </p>
                        <span>NIS: {{ $student->nis }}</span>
                    </div>
                </div>
                @empty
                <p style="color:#888; text-align:center; padding:20px 0;">Belum ada siswa terdaftar untuk kelas ini.</p>
                @endforelse
            </div>

            <!-- Daftar Pertemuan -->
            <div class="panel">
                <h2><i class="fas fa-calendar-alt"></i> Pertemuan 1 - 16 (Klik untuk Buka QR)</h2>
                <div class="meetings-grid">
                    @for($m = 1; $m <= 16; $m++)
                    <div class="meeting-card">
                        <div class="meeting-num">{{ $m }}</div>
                        <div class="meeting-label">Pertemuan ke-{{ $m }}</div>
                        <div class="attendance-count {{ ($attendanceData[$m] ?? 0) == 0 ? 'zero' : '' }}">
                            @if(($attendanceData[$m] ?? 0) > 0)
                            <i class="fas fa-check-circle"></i> {{ $attendanceData[$m] }} hadir
                            @else
                            Belum ada
                            @endif
                        </div>
                        <a href="{{ route('admin.attendance.qr', ['subject_id' => $subject->id, 'meeting' => $m]) }}" class="btn-qr" target="_blank">
                            <i class="fas fa-qrcode"></i> Buka QR
                        </a>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</body>
</html>
