<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi - {{ $subject->name }} Pertemuan {{ $meeting }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Outfit', sans-serif;
            background: linear-gradient(160deg, #0f172a 0%, #1e293b 60%, #2d1010 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .scan-card {
            background: white;
            border-radius: 28px;
            width: 100%;
            max-width: 420px;
            overflow: hidden;
            box-shadow: 0 30px 80px rgba(0,0,0,0.5);
        }

        /* Top banner */
        .card-banner {
            background: linear-gradient(135deg, #e30613, #8b0000);
            padding: 25px 30px;
            text-align: center;
            color: white;
        }
        .card-banner img { width: 55px; margin-bottom: 10px; }
        .card-banner .school { font-size: 0.7rem; letter-spacing: 2px; text-transform: uppercase; opacity: 0.8; margin-bottom: 12px; }
        .card-banner .meeting-badge { background: rgba(255,255,255,0.2); border: 1px solid rgba(255,255,255,0.3); padding: 4px 14px; border-radius: 50px; font-size: 0.75rem; font-weight: 700; display: inline-block; margin-bottom: 10px; }
        .card-banner h2 { font-size: 1.2rem; font-weight: 800; margin-bottom: 4px; }
        .card-banner p { font-size: 0.8rem; opacity: 0.85; }

        /* Form body */
        .card-body { padding: 28px 30px; }

        .alert {
            padding: 14px 16px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 0.87rem;
            font-weight: 600;
            display: flex;
            align-items: flex-start;
            gap: 10px;
            line-height: 1.5;
        }
        .alert-success { background: #ecfdf5; color: #065f46; border-left: 4px solid #10b981; }
        .alert-error { background: #fef2f2; color: #991b1b; border-left: 4px solid #ef4444; }
        .alert-warning { background: #fffbeb; color: #92400e; border-left: 4px solid #f59e0b; }
        .alert i { margin-top: 2px; flex-shrink: 0; }

        label { display: block; font-size: 0.85rem; font-weight: 700; color: #374151; margin-bottom: 8px; }

        .input-group { position: relative; margin-bottom: 10px; }
        .input-group i { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: #aaa; }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 15px 15px 15px 42px;
            border: 2px solid #e5e7eb;
            border-radius: 14px;
            font-size: 1.1rem;
            font-family: inherit;
            transition: 0.3s;
            background: #f9fafb;
        }
        input:focus { outline: none; border-color: #e30613; background: white; box-shadow: 0 0 0 4px rgba(227,6,19,0.08); }

        .hint { font-size: 0.75rem; color: #9ca3af; margin-bottom: 20px; }

        /* Student Quick Pick */
        .quick-pick { margin-bottom: 20px; }
        .quick-pick p { font-size: 0.8rem; font-weight: 700; color: #374151; margin-bottom: 8px; }
        .student-list { max-height: 150px; overflow-y: auto; border: 2px solid #e5e7eb; border-radius: 12px; }
        .student-list-item { padding: 10px 14px; font-size: 0.82rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center; transition: 0.2s; border-bottom: 1px solid #f3f4f6; }
        .student-list-item:last-child { border-bottom: none; }
        .student-list-item:hover { background: #fef2f2; }
        .student-list-item .nis { color: #9ca3af; font-size: 0.75rem; }

        .btn-submit {
            width: 100%;
            background: linear-gradient(135deg, #e30613, #b0050f);
            color: white;
            border: none;
            padding: 16px;
            border-radius: 14px;
            font-size: 1rem;
            font-weight: 800;
            cursor: pointer;
            transition: 0.3s;
            font-family: inherit;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 10px 25px rgba(227,6,19,0.3); }
        .btn-submit:active { transform: translateY(0); }

        .footer-info { text-align: center; margin-top: 18px; font-size: 0.75rem; color: #9ca3af; }
    </style>
</head>
<body>

<div class="scan-card">
    <!-- Banner -->
    <div class="card-banner">
        <img src="{{ asset('images/official_logo.png') }}" alt="Logo SMKS Aladelphi">
        <div class="school">SMKS Aladelphi Tiga Binanga</div>
        <div class="meeting-badge">📅 Pertemuan ke-{{ $meeting }}</div>
        <h2>{{ $subject->name }}</h2>
        <p>Kelas {{ $subject->class_name }} &bull; {{ \Carbon\Carbon::parse($date)->format('d M Y') }}</p>
    </div>

    <!-- Body -->
    <div class="card-body">
        {{-- Alert Messages --}}
        @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
        @endif
        @if(session('warning'))
        <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle"></i>
            <span>{{ session('warning') }}</span>
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-error">
            <i class="fas fa-times-circle"></i>
            <span>{{ session('error') }}</span>
        </div>
        @endif

        <form action="{{ route('attendance.submit', $token) }}" method="POST">
            @csrf
            <label for="nis">Nomor Induk Siswa (NIS)</label>
            <div class="input-group">
                <i class="fas fa-id-card"></i>
                <input type="text" id="nis" name="nis" placeholder="Masukkan NIS Anda..." required autofocus>
            </div>
            <p class="hint">💡 Klik nama di bawah untuk mengisi NIS secara otomatis</p>

            {{-- Quick Pick Siswa --}}
            @if($students->count() > 0)
            <div class="quick-pick">
                <p>👥 Daftar Siswa Kelas {{ $subject->class_name }}:</p>
                <div class="student-list">
                    @foreach($students as $student)
                    <div class="student-list-item" onclick="document.getElementById('nis').value='{{ $student->nis }}'">
                        <span>{{ $student->name }}</span>
                        <span class="nis">{{ $student->nis }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <button type="submit" class="btn-submit">
                <i class="fas fa-fingerprint"></i> Tandai HADIR
            </button>
        </form>

        <div class="footer-info">
            <i class="fas fa-shield-alt"></i> Data absensi tersimpan secara otomatis
        </div>
    </div>
</div>

</body>
</html>
