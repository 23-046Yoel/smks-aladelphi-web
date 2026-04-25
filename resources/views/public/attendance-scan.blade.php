<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi - {{ $subject->name }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .scan-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            padding: 40px;
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .icon {
            font-size: 3rem;
            color: #e30613;
            margin-bottom: 20px;
        }
        h2 {
            margin: 0 0 5px;
            font-weight: 800;
            color: #1a1a1a;
            font-size: 1.5rem;
        }
        p {
            color: #666;
            margin: 0 0 30px;
            font-size: 0.9rem;
        }
        .form-group {
            margin-bottom: 25px;
            text-align: left;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 0.9rem;
        }
        input {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 1.1rem;
            font-family: inherit;
            box-sizing: border-box;
            transition: 0.3s;
        }
        input:focus {
            outline: none;
            border-color: #e30613;
            box-shadow: 0 0 0 4px rgba(227, 6, 19, 0.1);
        }
        .btn-submit {
            width: 100%;
            background: linear-gradient(135deg, #e30613, #b0050f);
            color: white;
            border: none;
            padding: 15px;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(227, 6, 19, 0.2);
        }
        .alert {
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 25px;
            font-size: 0.9rem;
            font-weight: 600;
        }
        .alert-success { background: #e6f7ed; color: #28a745; border: 1px solid #c3e6cb; }
        .alert-error { background: #fdf2f2; color: #e30613; border: 1px solid #fadcdc; }
        
        .school-logo {
            width: 60px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="scan-card">
    <img src="{{ asset('images/official_logo.png') }}" alt="Logo" class="school-logo">
    <h2>Absensi Kelas</h2>
    <p>{{ $subject->name }} ({{ \Carbon\Carbon::parse($date)->format('d M Y') }})</p>

    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('attendance.submit', $token) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nis">Nomor Induk Siswa (NIS)</label>
            <input type="number" id="nis" name="nis" placeholder="Contoh: 10293847" required autofocus>
        </div>
        <button type="submit" class="btn-submit">
            <i class="fas fa-paper-plane"></i> Hadir
        </button>
    </form>
</div>

</body>
</html>
