<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Konten | Admin SMK Ala Delphi</title>
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
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px; }
        .btn { padding: 10px 20px; border-radius: 10px; text-decoration: none; font-weight: 600; transition: 0.3s; cursor: pointer; border: none; }
        .btn-primary { background: var(--red); color: white; }
        .panel { background: white; padding: 30px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.02); }
        table { width: 100%; border-collapse: collapse; }
        th { text-align: left; color: #888; padding-bottom: 15px; border-bottom: 2px solid #f0f0f0; }
        td { padding: 15px 0; border-bottom: 1px solid #f8f8f8; }
        .badge { padding: 5px 12px; border-radius: 50px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; }
        .badge-berita { background: #e3f2fd; color: #1976d2; }
        .badge-prestasi { background: #fff8e1; color: #fbc02d; }
        .badge-press_release { background: #f3e5f5; color: #7b1fa2; }
        .img-preview { width: 80px; height: 50px; object-fit: cover; border-radius: 8px; }
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
                <li><a href="#"><i class="fas fa-cog"></i> Pengaturan</a></li>
                <li style="margin-top: 50px;"><a href="{{ url('/') }}"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
        </nav>
    </div>
    <div class="main">
        <div class="header">
            <div>
                <h1 style="margin: 0;">Kelola Konten</h1>
                <p style="color: #888; margin: 5px 0 0;">Berita, Prestasi, dan Press Release</p>
            </div>
            <a href="{{ route('admin.posts.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Konten</a>
        </div>

        @if(session('success'))
            <div style="background: #e6f7ed; color: #28a745; padding: 15px; border-radius: 10px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        <div class="panel">
            <table>
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $post)
                    <tr>
                        <td>
                            @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" class="img-preview">
                            @else
                                <div class="img-preview" style="background: #eee; display: flex; align-items: center; justify-content: center;"><i class="fas fa-image" style="color: #ccc;"></i></div>
                            @endif
                        </td>
                        <td><strong>{{ $post->title }}</strong></td>
                        <td><span class="badge badge-{{ $post->category }}">{{ str_replace('_', ' ', $post->category) }}</span></td>
                        <td>{{ $post->published_at }}</td>
                        <td>
                            <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Hapus konten ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: none; border: none; color: #ff4d4d; cursor: pointer; font-size: 1.1rem;"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align: center; color: #888; padding: 40px;">Belum ada konten.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div style="margin-top: 20px;">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</body>
</html>
