<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pendaftar | Admin SMK Ala Delphi</title>
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
        .panel { background: white; padding: 30px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.02); }
        table { width: 100%; border-collapse: collapse; }
        th { text-align: left; color: #888; padding-bottom: 15px; border-bottom: 2px solid #f0f0f0; }
        td { padding: 15px 0; border-bottom: 1px solid #f8f8f8; font-size: 0.9rem; }
        .badge { padding: 5px 12px; border-radius: 50px; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; }
        .badge-pending { background: #fff8e1; color: #fbc02d; }
        .badge-verified { background: #e6f7ed; color: #28a745; }
        .badge-rejected { background: #ffebee; color: #f44336; }
        select { padding: 5px; border-radius: 5px; border: 1px solid #ddd; }
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
                <li><a href="{{ route('admin.posts.index') }}"><i class="fas fa-bullhorn"></i> Kelola Konten</a></li>
                <li><a href="{{ route('admin.registrations.index') }}" class="active"><i class="fas fa-user-plus"></i> Pendaftar SPMB</a></li>
                <li style="margin-top: 50px;"><a href="{{ url('/') }}"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
        </nav>
    </div>
    <div class="main">
        <div class="header" style="margin-bottom: 40px;">
            <h1 style="margin: 0;">Pendaftar Siswa Baru</h1>
            <p style="color: #888; margin: 5px 0 0;">Total pendaftar yang masuk melalui SPMB Online</p>
        </div>

        <div class="panel">
            <table>
                <thead>
                    <tr>
                        <th>No. Registrasi</th>
                        <th>Nama</th>
                        <th>Asal Sekolah</th>
                        <th>Jurusan</th>
                        <th>Kontak</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($registrations as $reg)
                    <tr>
                        <td><strong>{{ $reg->registration_number }}</strong></td>
                        <td>{{ $reg->name }}<br><small style="color: #888;">{{ $reg->gender }}</small></td>
                        <td>{{ $reg->previous_school }}</td>
                        <td>{{ $reg->major }}</td>
                        <td>{{ $reg->phone }}</td>
                        <td><span class="badge badge-{{ $reg->status }}">{{ $reg->status }}</span></td>
                        <td>
                            <form action="{{ route('admin.registrations.status', $reg->id) }}" method="POST">
                                @csrf
                                <select name="status" onchange="this.form.submit()">
                                    <option value="pending" {{ $reg->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="verified" {{ $reg->status == 'verified' ? 'selected' : '' }}>Verify</option>
                                    <option value="rejected" {{ $reg->status == 'rejected' ? 'selected' : '' }}>Reject</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="text-align: center; color: #888; padding: 40px;">Belum ada pendaftar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div style="margin-top: 20px;">
                {{ $registrations->links() }}
            </div>
        </div>
    </div>
</body>
</html>
