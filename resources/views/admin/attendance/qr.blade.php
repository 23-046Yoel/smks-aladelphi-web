<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Absensi - {{ $subject->name }} (Pertemuan {{ $meeting }})</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;600;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Outfit', sans-serif;
            background: linear-gradient(135deg, #1a1a1a 0%, #2d1010 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .qr-wrapper {
            display: flex;
            gap: 30px;
            align-items: stretch;
            max-width: 850px;
            width: 100%;
        }
        .qr-card {
            background: white;
            border-radius: 24px;
            padding: 40px 35px;
            text-align: center;
            flex: 1;
            box-shadow: 0 30px 60px rgba(0,0,0,0.4);
        }
        .school-logo { width: 65px; margin-bottom: 12px; }
        .school-name { font-size: 0.75rem; font-weight: 700; color: #888; letter-spacing: 2px; text-transform: uppercase; margin-bottom: 20px; }
        .meeting-badge {
            display: inline-block;
            background: linear-gradient(135deg, #e30613, #b0050f);
            color: white;
            padding: 5px 18px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 700;
            margin-bottom: 15px;
            letter-spacing: 1px;
        }
        .subject-name { font-size: 1.6rem; font-weight: 800; color: #1a1a1a; margin-bottom: 5px; }
        .class-info { font-size: 0.85rem; color: #e30613; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px; }
        .teacher-info { font-size: 0.8rem; color: #888; margin-bottom: 25px; }
        .qr-box {
            background: #fff;
            border: 3px solid #f0f0f0;
            border-radius: 20px;
            padding: 18px;
            display: inline-block;
            margin-bottom: 20px;
        }
        .qr-box img { width: 260px; height: 260px; display: block; }
        .scan-instruction { font-size: 0.85rem; color: #999; margin-bottom: 25px; line-height: 1.5; }
        .scan-instruction strong { color: #555; }
        .date-info { background: #f8f8f8; border-radius: 12px; padding: 10px 20px; font-size: 0.8rem; color: #888; margin-bottom: 20px; }
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #1a1a1a;
            color: white;
            padding: 12px 25px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.85rem;
            transition: 0.3s;
        }
        .btn-back:hover { background: #e30613; }

        /* Info panel */
        .info-panel {
            background: rgba(255,255,255,0.08);
            border-radius: 24px;
            padding: 30px 25px;
            width: 220px;
            flex-shrink: 0;
            color: white;
        }
        .info-panel h3 { font-size: 0.9rem; font-weight: 700; margin-bottom: 20px; color: #e30613; text-transform: uppercase; letter-spacing: 1px; }
        .info-item { margin-bottom: 18px; }
        .info-item .label { font-size: 0.7rem; color: #888; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px; }
        .info-item .value { font-size: 0.9rem; font-weight: 600; color: white; }
        .refresh-btn {
            display: block;
            text-align: center;
            background: linear-gradient(135deg, #e30613, #b0050f);
            color: white;
            padding: 12px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.8rem;
            margin-top: 25px;
            transition: 0.3s;
        }
        .refresh-btn:hover { opacity: 0.85; }

        /* Auto refresh countdown */
        .countdown { font-size: 0.75rem; color: #888; margin-top: 10px; text-align: center; }
    </style>
</head>
<body>

<div class="qr-wrapper">
    <!-- Left: Info Panel -->
    <div class="info-panel">
        <h3>📋 Info Kelas</h3>
        <div class="info-item">
            <div class="label">Mata Pelajaran</div>
            <div class="value">{{ $subject->name }}</div>
        </div>
        <div class="info-item">
            <div class="label">Kelas</div>
            <div class="value">{{ $subject->class_name }}</div>
        </div>
        <div class="info-item">
            <div class="label">Pengajar</div>
            <div class="value">{{ $subject->teacher_name }}</div>
        </div>
        <div class="info-item">
            <div class="label">Pertemuan</div>
            <div class="value">Ke-{{ $meeting }} dari 16</div>
        </div>
        <div class="info-item">
            <div class="label">Tanggal</div>
            <div class="value">{{ \Carbon\Carbon::parse($date)->format('d M Y') }}</div>
        </div>
        <div class="info-item">
            <div class="label">Jam Dibuka</div>
            <div class="value" id="current-time">{{ now()->format('H:i:s') }}</div>
        </div>
        <a href="{{ route('admin.attendance.qr', ['subject_id' => $subject->id, 'meeting' => $meeting]) }}" class="refresh-btn">
            🔄 Refresh QR
        </a>
        <div class="countdown" id="countdown">Auto refresh dalam <span id="timer">60</span>s</div>
    </div>

    <!-- Right: QR Card -->
    <div class="qr-card">
        <img src="{{ asset('images/official_logo.png') }}" alt="Logo" class="school-logo">
        <div class="school-name">SMKS Aladelphi Tiga Binanga</div>
        <div class="meeting-badge">📅 PERTEMUAN KE-{{ $meeting }}</div>
        <div class="subject-name">{{ $subject->name }}</div>
        <div class="class-info">Kelas {{ $subject->class_name }}</div>
        <div class="teacher-info">{{ $subject->teacher_name }}</div>

        <div class="qr-box">
            <img src="https://quickchart.io/qr?text={{ urlencode($scanUrl) }}&size=260&margin=2" alt="QR Code Absensi" onerror="this.src='https://api.qrserver.com/v1/create-qr-code/?size=260x260&data={{ urlencode($scanUrl) }}'">
        </div>

        <p class="scan-instruction">
            <strong>Cara Absen:</strong><br>
            1. Scan QR Code di atas menggunakan kamera HP<br>
            2. Masukkan NIS Anda di halaman yang terbuka<br>
            3. Klik tombol <strong>"Hadir"</strong>
        </p>

        <div class="date-info">
            📅 {{ \Carbon\Carbon::parse($date)->format('l, d F Y') }}
        </div>

        <a href="{{ route('admin.attendance.detail', $subject->id) }}" class="btn-back">
            ← Kembali ke Detail Kelas
        </a>
    </div>
</div>

<script>
    // Update jam setiap detik
    setInterval(function() {
        const now = new Date();
        const h = String(now.getHours()).padStart(2, '0');
        const m = String(now.getMinutes()).padStart(2, '0');
        const s = String(now.getSeconds()).padStart(2, '0');
        document.getElementById('current-time').textContent = h + ':' + m + ':' + s;
    }, 1000);

    // Auto refresh countdown
    let timeLeft = 60;
    setInterval(function() {
        timeLeft--;
        document.getElementById('timer').textContent = timeLeft;
        if (timeLeft <= 0) {
            window.location.reload();
        }
    }, 1000);
</script>
</body>
</html>
