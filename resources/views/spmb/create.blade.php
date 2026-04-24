<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formulir Pendaftaran | SMKS Aladelphi</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body { background: #f4f7f6; }
        .form-container {
            max-width: 800px;
            margin: 50px auto;
            background: white;
            padding: 50px;
            border-radius: 30px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.05);
        }
        .form-header { text-align: center; margin-bottom: 40px; }
        .form-group { margin-bottom: 25px; }
        label { display: block; margin-bottom: 10px; font-weight: 600; color: #444; }
        input, select, textarea { 
            width: 100%; padding: 15px; border: 2px solid #eee; border-radius: 15px; 
            font-family: inherit; font-size: 1rem; transition: 0.3s; box-sizing: border-box;
        }
        input:focus, select:focus, textarea:focus { border-color: #e30613; outline: none; background: #fffcfc; }
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .success-msg {
            background: #e6f7ed; color: #28a745; padding: 20px; border-radius: 15px;
            margin-bottom: 30px; text-align: center; font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <div class="form-header">
                <img src="{{ asset('images/official_logo.png') }}" alt="Logo" style="height: 80px; margin-bottom: 20px;">
                <h2>Formulir Pendaftaran Siswa Baru</h2>
                <p style="color: #888;">Silakan lengkapi data di bawah ini dengan benar</p>
            </div>

            @if(session('success'))
                <div class="success-msg">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <br><br>
                    <a href="{{ url('/') }}" style="color: #28a745; text-decoration: underline;">Kembali ke Beranda</a>
                </div>
            @endif

            <form action="{{ route('spmb.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" placeholder="Sesuai Ijazah..." required>
                </div>

                <div class="grid-2">
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="gender" required>
                            <option value="">Pilih...</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>No. HP / WhatsApp</label>
                        <input type="tel" name="phone" placeholder="08..." required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Email (Opsional)</label>
                    <input type="email" name="email" placeholder="contoh@mail.com">
                </div>

                <div class="form-group">
                    <label>Asal Sekolah (SMP/MTs)</label>
                    <input type="text" name="previous_school" placeholder="Nama sekolah asal..." required>
                </div>

                <div class="form-group">
                    <label>Pilihan Jurusan</label>
                    <select name="major" required>
                        <option value="">Pilih Jurusan...</option>
                        <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak (RPL)</option>
                        <option value="Teknik Komputer & Jaringan">Teknik Komputer & Jaringan (TKJ)</option>
                        <option value="Akuntansi">Akuntansi</option>
                        <option value="Perkantoran">Otomatisasi Perkantoran</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Alamat Lengkap</label>
                    <textarea name="address" rows="4" placeholder="Alamat rumah..." required></textarea>
                </div>

                <div style="margin-top: 40px;">
                    <button type="submit" class="btn-primary" style="width: 100%; padding: 18px; border-radius: 15px; font-size: 1.1rem; border: none; cursor: pointer;">KIRIM PENDAFTARAN ❯</button>
                    <p style="text-align: center; margin-top: 20px;"><a href="{{ route('spmb.index') }}" style="color: #888; text-decoration: none;">Batal</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
