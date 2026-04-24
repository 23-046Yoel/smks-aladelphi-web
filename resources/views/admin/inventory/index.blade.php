<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Inventaris - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f4f6f9; display: flex; min-height: 100vh; }
        .sidebar { width: 260px; background: #1a1a2e; color: white; padding: 30px 0; flex-shrink: 0; }
        .sidebar-logo { padding: 0 25px 30px; border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 20px; }
        .sidebar-menu { list-style: none; padding: 0 15px; }
        .sidebar-menu li a { display: flex; align-items: center; gap: 12px; padding: 12px 15px; border-radius: 10px; color: rgba(255,255,255,0.6); text-decoration: none; font-size: 0.9rem; font-weight: 600; transition: 0.2s; }
        .sidebar-menu li a:hover, .sidebar-menu li a.active { background: #e30613; color: white; }
        .main { flex: 1; padding: 35px; }
        .topbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px; }
        .topbar h1 { font-size: 1.5rem; font-weight: 800; color: #1a1a2e; }
        .btn { padding: 12px 25px; border-radius: 10px; font-weight: 700; font-size: 0.85rem; cursor: pointer; border: none; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; }
        .btn-primary { background: #e30613; color: white; }
        .card { background: white; border-radius: 20px; box-shadow: 0 5px 25px rgba(0,0,0,0.05); overflow: hidden; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #f8f9fa; padding: 15px 20px; text-align: left; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: #666; }
        td { padding: 15px 20px; border-bottom: 1px solid #f5f5f5; font-size: 0.9rem; }
        .badge { padding: 4px 12px; border-radius: 30px; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; }
        .badge-baik { background: #e6f7ed; color: #28a745; }
        .badge-rusak { background: #fdf2f2; color: #e30613; }
        .action-btns { display: flex; gap: 8px; }
        .btn-sm { padding: 6px 12px; border-radius: 8px; font-size: 0.75rem; font-weight: 700; text-decoration: none; }
        .btn-edit { background: #fff3cd; color: #856404; }
        .btn-delete { background: #f8d7da; color: #721c24; border: none; cursor: pointer; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-logo">
        <h2 style="font-size: 1rem;">SMK ALA DELPHI</h2>
        <p style="font-size: 0.7rem; color: #888;">Admin Dashboard</p>
    </div>
    <ul class="sidebar-menu">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fas fa-th-large"></i> Dashboard</a></li>
        <li><a href="{{ route('admin.posts.index') }}"><i class="fas fa-bullhorn"></i> Berita</a></li>
        <li><a href="{{ route('admin.employees.index') }}"><i class="fas fa-users"></i> Kepegawaian</a></li>
        <li><a href="{{ route('admin.inventory.index') }}" class="active"><i class="fas fa-boxes"></i> Inventaris & Gudang</a></li>
    </ul>
</div>

<div class="main">
    <div class="topbar">
        <h1>Manajemen Inventaris & Gudang</h1>
        <a href="{{ route('admin.inventory.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Aset</a>
    </div>

    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 10px; margin-bottom: 25px;">{{ session('success') }}</div>
    @endif

    <div class="card">
        <table>
            <thead>
                <tr>
                    <th>Kode Aset</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Lokasi</th>
                    <th>Jumlah</th>
                    <th>Kondisi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                <tr>
                    <td><code>{{ $item->asset_code ?? '-' }}</code></td>
                    <td><strong>{{ $item->name }}</strong></td>
                    <td>{{ $item->category }}</td>
                    <td>{{ $item->location }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td><span class="badge badge-{{ $item->condition == 'baik' ? 'baik' : 'rusak' }}">{{ str_replace('_', ' ', $item->condition) }}</span></td>
                    <td>
                        <div class="action-btns">
                            <a href="{{ route('admin.inventory.edit', $item->id) }}" class="btn-sm btn-edit"><i class="fas fa-edit"></i> Edit</a>
                            <form action="{{ route('admin.inventory.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus aset ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-sm btn-delete"><i class="fas fa-trash"></i> Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" style="text-align: center; padding: 50px; color: #aaa;">Belum ada data barang.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div style="padding: 20px;">{{ $items->links() }}</div>
    </div>
</div>

</body>
</html>
