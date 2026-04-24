<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Konten | Admin SMK Ala Delphi</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --red: #e30613; --dark: #1a1a1a; --light: #f8f9fa; }
        body { font-family: 'Outfit', sans-serif; margin: 0; display: flex; background: var(--light); }
        .sidebar { width: 260px; height: 100vh; background: var(--dark); color: white; padding: 30px 20px; position: fixed; }
        .sidebar-header { display: flex; align-items: center; gap: 10px; margin-bottom: 50px; }
        .sidebar nav ul { list-style: none; padding: 0; }
        .sidebar nav ul li a { color: #bbb; text-decoration: none; display: flex; align-items: center; gap: 12px; padding: 12px 15px; border-radius: 12px; transition: 0.3s; }
        .sidebar nav ul li a:hover, .sidebar nav ul li a.active { background: rgba(227, 6, 19, 0.1); color: var(--red); font-weight: 600; }
        .main { margin-left: 260px; padding: 40px; width: calc(100% - 260px); }
        .panel { background: white; padding: 40px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.02); max-width: 800px; }
        .form-group { margin-bottom: 25px; }
        label { display: block; margin-bottom: 10px; font-weight: 600; color: #444; }
        input, select, textarea { width: 100%; padding: 12px 15px; border: 1px solid #ddd; border-radius: 10px; font-family: inherit; font-size: 1rem; box-sizing: border-box; }
        textarea { height: 150px; }
        .btn { padding: 12px 30px; border-radius: 10px; text-decoration: none; font-weight: 600; transition: 0.3s; cursor: pointer; border: none; font-size: 1rem; }
        .btn-primary { background: var(--red); color: white; }
        .btn-secondary { background: #eee; color: #444; margin-right: 10px; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <img src="{{ asset('images/official_logo.png') }}" alt="Logo" style="height: 40px;">
            <h3>ADMIN PANEL</h3>
        </div>
        <nav>
            <ul>
                <li><a href="{{ route('admin.dashboard') }}"><i class="fas fa-th-large"></i> Dashboard</a></li>
                <li><a href="{{ route('admin.posts.index') }}" class="active"><i class="fas fa-bullhorn"></i> Kelola Konten</a></li>
                <li><a href="#"><i class="fas fa-users"></i> Data Siswa</a></li>
                <li style="margin-top: 50px;"><a href="{{ url('/') }}"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
        </nav>
    </div>
    <div class="main">
        <div class="header">
            <h1 style="margin: 0;">Tambah Konten Baru</h1>
        </div>

        <div class="panel">
            <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Judul Konten</label>
                    <input type="text" name="title" placeholder="Masukkan judul..." required>
                </div>

                <div class="form-group">
                    <label>Kategori</label>
                    <select name="category" required>
                        <option value="berita">Berita</option>
                        <option value="prestasi">Prestasi</option>
                        <option value="press_release">Press Release</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Isi Konten</label>
                    <textarea name="content" placeholder="Tuliskan isi berita di sini..." required></textarea>
                </div>

                <div class="form-group">
                    <label>Tanggal Publikasi</label>
                    <input type="date" name="published_at" value="{{ date('Y-m-d') }}" required>
                </div>

                <div class="form-group">
                    <label>Gambar Utama</label>
                    <input type="file" name="image" accept="image/*">
                    <p style="font-size: 0.8rem; color: #888; margin-top: 5px;">Format: JPG, PNG. Maks 2MB.</p>
                </div>

                <div style="margin-top: 40px;">
                    <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Konten</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
