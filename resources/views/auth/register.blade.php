<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Siswa Baru | SMK Ala Delphi</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --red: #e30613;
            --dark: #001f3f;
            --gold: #c5a059;
        }
        body {
            font-family: 'Outfit', sans-serif;
            background: #f4f7f6;
            margin: 0;
            padding: 50px 5%;
        }
        .register-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 50px;
            border-radius: 30px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 40px;
        }
        .header h1 {
            color: var(--dark);
            font-weight: 800;
            margin-bottom: 10px;
        }
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group.full {
            grid-column: span 2;
        }
        label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #555;
        }
        input, select, textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #eee;
            border-radius: 12px;
            font-family: inherit;
            box-sizing: border-box;
        }
        .btn-submit {
            grid-column: span 2;
            padding: 15px;
            background: var(--gold);
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 800;
            font-size: 1.1rem;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 20px;
        }
        .btn-submit:hover {
            background: #a6864a;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="header">
            <img src="{{ asset('images/official_logo.png') }}" alt="Logo" style="height: 80px; margin-bottom: 20px;">
            <h1>FORM PENDAFTARAN SISWA BARU</h1>
            <p>Tahun Pelajaran 2026/2027</p>
        </div>
        <form class="form-grid">
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" placeholder="Masukkan nama lengkap">
            </div>
            <div class="form-group">
                <label>NISN</label>
                <input type="text" placeholder="Masukkan NISN">
            </div>
            <div class="form-group">
                <label>Tempat Lahir</label>
                <input type="text" placeholder="Kota Kelahiran">
            </div>
            <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date">
            </div>
            <div class="form-group">
                <label>Jenis Kelamin</label>
                <select>
                    <option>Laki-laki</option>
                    <option>Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label>Asal Sekolah (SMP)</label>
                <input type="text" placeholder="Nama SMP Asal">
            </div>
            <div class="form-group full">
                <label>Pilihan Jurusan</label>
                <select>
                    <option>Rekayasa Perangkat Lunak (RPL)</option>
                    <option>Teknik Komputer & Jaringan (TKJ)</option>
                    <option>Akuntansi & Keuangan Lembaga</option>
                </select>
            </div>
            <div class="form-group full">
                <label>Alamat Lengkap</label>
                <textarea rows="3" placeholder="Masukkan alamat lengkap rumah"></textarea>
            </div>
            <button type="button" class="btn-submit" onclick="alert('Pendaftaran Berhasil Dikirim!')">KIRIM PENDAFTARAN SEKARANG</button>
        </form>
        <div style="text-align: center; margin-top: 30px;">
            <a href="{{ url('/') }}" style="color: #888; text-decoration: none;">❮ Kembali ke Beranda</a>
        </div>
    </div>
</body>
</html>
