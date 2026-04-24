<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pegawai - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f4f6f9; display: flex; min-height: 100vh; }
        .sidebar { width: 260px; background: #1a1a2e; color: white; padding: 30px 0; flex-shrink: 0; }
        .sidebar-logo { padding: 0 25px 30px; border-bottom: 1px solid rgba(255,255,255,0.08); margin-bottom: 20px; }
        .sidebar-logo h2 { font-size: 0.9rem; font-weight: 800; color: white; }
        .sidebar-logo p { font-size: 0.7rem; color: rgba(255,255,255,0.5); margin-top: 3px; }
        .sidebar-menu { list-style: none; padding: 0 15px; }
        .sidebar-menu li a { display: flex; align-items: center; gap: 12px; padding: 12px 15px; border-radius: 10px; color: rgba(255,255,255,0.7); text-decoration: none; font-size: 0.88rem; font-weight: 600; transition: 0.2s; margin-bottom: 3px; }
        .sidebar-menu li a:hover, .sidebar-menu li a.active { background: #e30613; color: white; }
        .sidebar-menu li a i { width: 18px; text-align: center; }
        .sidebar-section { font-size: 0.68rem; text-transform: uppercase; letter-spacing: 2px; color: rgba(255,255,255,0.3); padding: 15px 25px 8px; }
        .main { flex: 1; }
        .topbar { background: white; padding: 18px 35px; display: flex; align-items: center; gap: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .topbar a { color: #888; text-decoration: none; font-size: 0.88rem; }
        .topbar h1 { font-size: 1.2rem; font-weight: 800; }
        .content { padding: 35px; }
        .form-card { background: white; border-radius: 20px; padding: 40px; box-shadow: 0 2px 15px rgba(0,0,0,0.06); max-width: 750px; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .form-group { display: flex; flex-direction: column; gap: 8px; }
        .form-group.full { grid-column: 1 / -1; }
        label { font-size: 0.82rem; font-weight: 700; color: #444; text-transform: uppercase; letter-spacing: 0.5px; }
        input, select, textarea { padding: 12px 16px; border: 2px solid #eee; border-radius: 12px; font-size: 0.9rem; font-family: 'Inter', sans-serif; transition: 0.2s; }
        input:focus, select:focus, textarea:focus { outline: none; border-color: #e30613; }
        .form-actions { display: flex; gap: 15px; margin-top: 30px; }
        .btn { padding: 12px 28px; border-radius: 12px; font-weight: 700; font-size: 0.9rem; cursor: pointer; border: none; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; }
        .btn-primary { background: #e30613; color: white; }
        .btn-secondary { background: #f0f0f0; color: #333; }
        .photo-preview { width: 100px; height: 100px; border-radius: 15px; object-fit: cover; border: 3px solid #eee; margin-top: 10px; display: none; }
        .error { color: #e30613; font-size: 0.8rem; font-weight: 600; }
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
        <a href="{{ route('admin.employees.index') }}"><i class="fas fa-arrow-left"></i> Kembali</a>
        <h1>Tambah Data Pegawai</h1>
    </div>

    <div class="content">
        <div class="form-card">
            <form action="{{ route('admin.employees.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-grid">
                    <div class="form-group full">
                        <label>Nama Lengkap *</label>
                        <input type="text" name="name" value="{{ old('name') }}" required placeholder="Masukkan nama lengkap">
                        @error('name')<span class="error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>NIP</label>
                        <input type="text" name="nip" value="{{ old('nip') }}" placeholder="Nomor Induk Pegawai">
                    </div>
                    <div class="form-group">
                        <label>Jenis Pegawai *</label>
                        <select name="employee_type" required>
                            <option value="guru" {{ old('employee_type') == 'guru' ? 'selected' : '' }}>Guru</option>
                            <option value="staff" {{ old('employee_type') == 'staff' ? 'selected' : '' }}>Staff</option>
                            <option value="tata_usaha" {{ old('employee_type') == 'tata_usaha' ? 'selected' : '' }}>Tata Usaha</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jabatan *</label>
                        <input type="text" name="position" value="{{ old('position') }}" required placeholder="Contoh: Guru Matematika">
                    </div>
                    <div class="form-group">
                        <label>Mata Pelajaran (Guru)</label>
                        <input type="text" name="subject" value="{{ old('subject') }}" placeholder="Contoh: Matematika, Bahasa Indonesia">
                    </div>
                    <div class="form-group">
                        <label>Pendidikan Terakhir</label>
                        <input type="text" name="education" value="{{ old('education') }}" placeholder="Contoh: S1 Pendidikan Matematika">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="email@example.com">
                    </div>
                    <div class="form-group">
                        <label>No. HP / Telepon</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="08xx-xxxx-xxxx">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status">
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Non-Aktif</option>
                        </select>
                    </div>
                    <div class="form-group full">
                        <label>Foto Pegawai</label>
                        <input type="file" name="photo" accept="image/*" onchange="previewPhoto(this)">
                        <img id="photoPreview" class="photo-preview">
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Data</button>
                    <a href="{{ route('admin.employees.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function previewPhoto(input) {
    const preview = document.getElementById('photoPreview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { preview.src = e.target.result; preview.style.display = 'block'; };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
</body>
</html>
