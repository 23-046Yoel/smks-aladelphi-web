<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Kepegawaian - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f4f6f9; display: flex; min-height: 100vh; }
        .sidebar { width: 260px; background: #1a1a2e; color: white; padding: 30px 0; flex-shrink: 0; }
        .sidebar-logo { padding: 0 25px 30px; border-bottom: 1px solid rgba(255,255,255,0.08); margin-bottom: 20px; }
        .sidebar-logo h2 { font-size: 0.9rem; font-weight: 800; color: white; line-height: 1.5; }
        .sidebar-logo p { font-size: 0.7rem; color: rgba(255,255,255,0.5); margin-top: 3px; }
        .sidebar-menu { list-style: none; padding: 0 15px; }
        .sidebar-menu li a { display: flex; align-items: center; gap: 12px; padding: 12px 15px; border-radius: 10px; color: rgba(255,255,255,0.7); text-decoration: none; font-size: 0.88rem; font-weight: 600; transition: 0.2s; margin-bottom: 3px; }
        .sidebar-menu li a:hover, .sidebar-menu li a.active { background: #e30613; color: white; }
        .sidebar-menu li a i { width: 18px; text-align: center; }
        .sidebar-section { font-size: 0.68rem; text-transform: uppercase; letter-spacing: 2px; color: rgba(255,255,255,0.3); padding: 15px 25px 8px; }
        .main { flex: 1; display: flex; flex-direction: column; overflow: hidden; }
        .topbar { background: white; padding: 18px 35px; display: flex; align-items: center; justify-content: space-between; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .topbar h1 { font-size: 1.3rem; font-weight: 800; color: #1a1a1a; }
        .topbar-actions { display: flex; gap: 10px; }
        .btn { padding: 10px 22px; border-radius: 10px; font-weight: 700; font-size: 0.85rem; cursor: pointer; border: none; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; transition: 0.2s; }
        .btn-primary { background: #e30613; color: white; }
        .btn-primary:hover { background: #c00; }
        .btn-secondary { background: #f0f0f0; color: #333; }
        .content { flex: 1; padding: 35px; overflow-y: auto; }
        .alert { padding: 14px 20px; border-radius: 12px; margin-bottom: 25px; font-weight: 600; }
        .alert-success { background: #d4edda; color: #155724; border-left: 4px solid #28a745; }
        .card { background: white; border-radius: 16px; box-shadow: 0 2px 15px rgba(0,0,0,0.06); overflow: hidden; }
        .card-header { padding: 20px 25px; border-bottom: 1px solid #f0f0f0; display: flex; justify-content: space-between; align-items: center; }
        .card-header h3 { font-size: 1rem; font-weight: 800; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #f8f9fa; padding: 12px 20px; text-align: left; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: #666; font-weight: 700; }
        td { padding: 14px 20px; border-bottom: 1px solid #f5f5f5; font-size: 0.88rem; vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #fafafa; }
        .emp-photo-sm { width: 45px; height: 45px; border-radius: 10px; object-fit: cover; background: #eee; }
        .badge { padding: 4px 12px; border-radius: 30px; font-size: 0.72rem; font-weight: 700; text-transform: uppercase; }
        .badge-aktif { background: #d4edda; color: #155724; }
        .badge-nonaktif { background: #f8d7da; color: #721c24; }
        .badge-guru { background: #cce5ff; color: #004085; }
        .badge-staff { background: #fff3cd; color: #856404; }
        .badge-tu { background: #e2d9f3; color: #4a235a; }
        .action-btns { display: flex; gap: 8px; }
        .btn-edit { padding: 6px 14px; background: #fff3cd; color: #856404; border-radius: 8px; font-weight: 700; font-size: 0.78rem; text-decoration: none; transition: 0.2s; }
        .btn-delete { padding: 6px 14px; background: #f8d7da; color: #721c24; border-radius: 8px; font-weight: 700; font-size: 0.78rem; cursor: pointer; border: none; transition: 0.2s; }
        .btn-edit:hover { background: #ffc107; }
        .btn-delete:hover { background: #e30613; color: white; }
        .empty-row td { text-align: center; padding: 50px; color: #aaa; }
        .pagination { padding: 20px 25px; }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="sidebar-logo">
        <h2>SMK SWASTA ALA DELPHI</h2>
        <p>Panel Administrator</p>
    </div>
    <ul class="sidebar-menu">
        <li><a href="{{ url('/admin/dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
        <div class="sidebar-section">Konten</div>
        <li><a href="{{ url('/admin/posts') }}"><i class="fas fa-newspaper"></i> Manajemen Berita</a></li>
        <li><a href="{{ url('/admin/registrations') }}"><i class="fas fa-user-plus"></i> Data SPMB</a></li>
        <div class="sidebar-section">SDM</div>
        <li><a href="{{ route('admin.employees.index') }}" class="active"><i class="fas fa-users"></i> Kepegawaian & HR</a></li>
    </ul>
</div>

<div class="main">
    <div class="topbar">
        <h1><i class="fas fa-users" style="color:#e30613; margin-right:10px;"></i>Manajemen Kepegawaian & HR</h1>
        <div class="topbar-actions">
            <a href="{{ url('/kepegawaian') }}" target="_blank" class="btn btn-secondary"><i class="fas fa-eye"></i> Lihat Halaman Publik</a>
            <a href="{{ route('admin.employees.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Pegawai</a>
        </div>
    </div>

    <div class="content">
        @if(session('success'))
        <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3>Daftar Seluruh Pegawai</h3>
                <span style="font-size:0.85rem; color:#888;">Total: {{ $employees->total() }} pegawai</span>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>NIP</th>
                        <th>Jabatan</th>
                        <th>Jenis</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $index => $emp)
                    <tr>
                        <td>{{ $employees->firstItem() + $index }}</td>
                        <td>
                            @if($emp->photo)
                                <img src="{{ Storage::url($emp->photo) }}" class="emp-photo-sm" alt="">
                            @else
                                <div class="emp-photo-sm" style="display:flex;align-items:center;justify-content:center;"><i class="fas fa-user" style="color:#ccc;"></i></div>
                            @endif
                        </td>
                        <td><strong>{{ $emp->name }}</strong>@if($emp->subject)<br><small style="color:#888;">{{ $emp->subject }}</small>@endif</td>
                        <td style="color:#888;">{{ $emp->nip ?? '-' }}</td>
                        <td>{{ $emp->position }}</td>
                        <td>
                            @if($emp->employee_type == 'guru')
                                <span class="badge badge-guru">Guru</span>
                            @elseif($emp->employee_type == 'staff')
                                <span class="badge badge-staff">Staff</span>
                            @else
                                <span class="badge badge-tu">Tata Usaha</span>
                            @endif
                        </td>
                        <td><span class="badge badge-{{ $emp->status }}">{{ ucfirst($emp->status) }}</span></td>
                        <td>
                            <div class="action-btns">
                                <a href="{{ route('admin.employees.edit', $emp->id) }}" class="btn-edit"><i class="fas fa-edit"></i> Edit</a>
                                <form action="{{ route('admin.employees.destroy', $emp->id) }}" method="POST" onsubmit="return confirm('Hapus data {{ $emp->name }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-delete"><i class="fas fa-trash"></i> Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="empty-row"><i class="fas fa-users" style="font-size:2rem;display:block;margin-bottom:10px;"></i>Belum ada data pegawai</td></tr>
                    @endforelse
                </tbody>
            </table>
            <div class="pagination">{{ $employees->links() }}</div>
        </div>
    </div>
</div>

</body>
</html>
