<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Absensi — {{ $subject->name }} Pertemuan {{ $meeting }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --red: #e30613; }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Outfit', sans-serif;
            background: #111;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }
        .wrapper {
            display: flex;
            gap: 24px;
            width: 100%;
            max-width: 900px;
            align-items: stretch;
        }

        /* Info Sidebar */
        .info-sidebar {
            width: 210px;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }
        .info-card {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 16px;
            padding: 18px 16px;
        }
        .info-card .label {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #666;
            margin-bottom: 5px;
        }
        .info-card .value {
            font-size: 0.9rem;
            font-weight: 700;
            color: white;
            line-height: 1.3;
        }
        .info-card .value.red { color: var(--red); font-size: 1.6rem; }
        .time-card {
            background: linear-gradient(135deg, rgba(227,6,19,0.15), rgba(139,0,0,0.1));
            border: 1px solid rgba(227,6,19,0.2);
            border-radius: 16px;
            padding: 18px 16px;
            text-align: center;
        }
        .time-card .time-val { font-size: 1.8rem; font-weight: 800; color: white; letter-spacing: 2px; }
        .time-card .time-label { font-size: 0.68rem; color: #666; text-transform: uppercase; letter-spacing: 1px; margin-top: 3px; }
        .btn-back-sidebar {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: rgba(255,255,255,0.07);
            color: #aaa;
            padding: 12px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.82rem;
            transition: 0.2s;
            border: 1px solid rgba(255,255,255,0.08);
            margin-top: auto;
        }
        .btn-back-sidebar:hover { background: rgba(255,255,255,0.12); color: white; }

        /* QR Card */
        .qr-card {
            flex: 1;
            background: white;
            border-radius: 24px;
            padding: 36px 32px;
            text-align: center;
            box-shadow: 0 40px 80px rgba(0,0,0,0.5);
        }
        .school-logo { height: 60px; margin-bottom: 10px; }
        .school-name { font-size: 0.72rem; font-weight: 700; color: #999; letter-spacing: 2px; text-transform: uppercase; margin-bottom: 18px; }
        .meeting-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: #1a1a1a;
            color: white;
            padding: 6px 18px;
            border-radius: 6px;
            font-size: 0.78rem;
            font-weight: 700;
            margin-bottom: 14px;
            letter-spacing: 0.5px;
        }
        .meeting-badge .num { color: var(--red); font-size: 1rem; }
        .subject-title { font-size: 1.7rem; font-weight: 800; color: #1a1a1a; margin-bottom: 4px; }
        .class-label { font-size: 0.82rem; font-weight: 700; color: var(--red); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px; }
        .teacher-label { font-size: 0.8rem; color: #aaa; margin-bottom: 24px; }
        .qr-frame {
            border: 3px solid #f0f0f0;
            border-radius: 20px;
            padding: 16px;
            display: inline-block;
            margin-bottom: 18px;
            background: white;
        }
        .qr-frame img { width: 240px; height: 240px; display: block; }
        .scan-steps {
            display: flex;
            justify-content: center;
            gap: 24px;
            margin-bottom: 20px;
        }
        .step { display: flex; flex-direction: column; align-items: center; gap: 6px; }
        .step .step-icon { width: 36px; height: 36px; border-radius: 50%; background: #f4f6f9; display: flex; align-items: center; justify-content: center; font-size: 0.9rem; color: var(--red); }
        .step .step-text { font-size: 0.72rem; color: #888; max-width: 80px; line-height: 1.3; }
        .step-divider { width: 30px; height: 1px; background: #e5e7eb; align-self: center; margin-bottom: 18px; }
        .date-strip { background: #f9fafb; border-radius: 10px; padding: 8px 20px; font-size: 0.8rem; color: #888; display: inline-block; }
        .date-strip i { color: var(--red); margin-right: 5px; }
    </style>
</head>
<body>

<div class="wrapper">
    <!-- Info Sidebar -->
    <div class="info-sidebar">
        <div class="time-card">
            <div class="time-val" id="clock">--:--:--</div>
            <div class="time-label">Waktu Sekarang</div>
        </div>
        <div class="info-card">
            <div class="label">Kelas</div>
            <div class="value">{{ $subject->class_name }}</div>
        </div>
        <div class="info-card">
            <div class="label">Pengajar</div>
            <div class="value">{{ $subject->teacher_name }}</div>
        </div>
        <div class="info-card">
            <div class="label">Pertemuan</div>
            <div class="value red">{{ $meeting }}</div>
            <div class="label" style="margin-top:4px;">dari 16 pertemuan</div>
        </div>
        <div class="info-card">
            <div class="label">Tanggal</div>
            <div class="value">{{ \Carbon\Carbon::parse($date)->format('d M Y') }}</div>
        </div>
        <a href="{{ route('admin.attendance.detail', $subject->id) }}" class="btn-back-sidebar">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- QR Code Card -->
    <div class="qr-card">
        <img src="{{ asset('images/official_logo.png') }}" alt="Logo" class="school-logo">
        <div class="school-name">SMKS Aladelphi Tiga Binanga</div>

        <div class="meeting-badge">
            <i class="fas fa-calendar-check"></i>
            Pertemuan ke-<span class="num">{{ $meeting }}</span>
        </div>

        <div class="subject-title">{{ $subject->name }}</div>
        <div class="class-label">Kelas {{ $subject->class_name }}</div>
        <div class="teacher-label"><i class="fas fa-chalkboard-teacher"></i> {{ $subject->teacher_name }}</div>

        <div class="qr-frame">
            <img src="https://quickchart.io/qr?text={{ urlencode($scanUrl) }}&size=240&margin=2"
                 alt="QR Code"
                 onerror="this.src='https://api.qrserver.com/v1/create-qr-code/?size=240x240&data={{ urlencode($scanUrl) }}'">
        </div>

        <!-- Langkah scan -->
        <div class="scan-steps">
            <div class="step">
                <div class="step-icon"><i class="fas fa-mobile-alt"></i></div>
                <div class="step-text">Buka kamera HP</div>
            </div>
            <div class="step-divider"></div>
            <div class="step">
                <div class="step-icon"><i class="fas fa-qrcode"></i></div>
                <div class="step-text">Scan QR code</div>
            </div>
            <div class="step-divider"></div>
            <div class="step">
                <div class="step-icon"><i class="fas fa-id-card"></i></div>
                <div class="step-text">Masukkan NIS</div>
            </div>
            <div class="step-divider"></div>
            <div class="step">
                <div class="step-icon"><i class="fas fa-check"></i></div>
                <div class="step-text">Absen tercatat</div>
            </div>
        </div>

        <div class="date-strip">
            <i class="fas fa-clock"></i>
            {{ \Carbon\Carbon::parse($date)->translatedFormat('l, d F Y') }}
        </div>
    </div>
</div>

<script>
    // Live clock only — no auto refresh
    function updateClock() {
        const now = new Date();
        const h = String(now.getHours()).padStart(2, '0');
        const m = String(now.getMinutes()).padStart(2, '0');
        const s = String(now.getSeconds()).padStart(2, '0');
        document.getElementById('clock').textContent = h + ':' + m + ':' + s;
    }
    updateClock();
    setInterval(updateClock, 1000);
</script>

</body>
</html>
