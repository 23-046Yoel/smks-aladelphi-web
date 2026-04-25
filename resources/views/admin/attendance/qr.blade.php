<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Absensi - {{ $subject->name }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;600;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            text-align: center;
        }
        .qr-container {
            background: white;
            padding: 50px;
            border-radius: 30px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.1);
            max-width: 500px;
            width: 90%;
        }
        h1 {
            color: #1a1a1a;
            font-size: 2.2rem;
            margin: 0 0 10px 0;
            font-weight: 800;
        }
        h3 {
            color: #e30613;
            margin: 0 0 30px 0;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .qr-code {
            padding: 20px;
            background: #fff;
            border: 4px solid #f0f0f0;
            border-radius: 20px;
            display: inline-block;
            margin-bottom: 30px;
        }
        .qr-code img {
            width: 300px;
            height: 300px;
            display: block;
        }
        p {
            color: #888;
            font-size: 1.1rem;
            margin-bottom: 20px;
        }
        .btn-back {
            display: inline-block;
            background: #1a1a1a;
            color: white;
            text-decoration: none;
            padding: 15px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: 0.3s;
        }
        .btn-back:hover {
            background: #e30613;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

<div class="qr-container">
    <h1>{{ $subject->name }}</h1>
    <h3>{{ $subject->teacher_name }}</h3>
    
    <div class="qr-code">
        <!-- Generate QR Code using Google Chart API -->
        <img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl={{ urlencode($scanUrl) }}&choe=UTF-8" alt="QR Code Absensi">
    </div>

    <p>Silakan scan QR Code di atas menggunakan kamera HP Anda untuk melakukan absensi kehadiran.</p>
    
    <a href="{{ route('admin.attendance.index') }}" class="btn-back">Kembali ke Dashboard</a>
</div>

</body>
</html>
