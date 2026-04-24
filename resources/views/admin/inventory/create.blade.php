<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Aset - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f4f6f9; display: flex; min-height: 100vh; }
        .sidebar { width: 260px; background: #1a1a2e; color: white; padding: 30px 0; flex-shrink: 0; }
        .main { flex: 1; padding: 35px; }
        .topbar { display: flex; align-items: center; gap: 15px; margin-bottom: 40px; }
        .form-card { background: white; border-radius: 20px; padding: 40px; box-shadow: 0 5px 25px rgba(0,0,0,0.05); max-width: 800px; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 25px; }
        .form-group { display: flex; flex-direction: column; gap: 8px; }
        .full { grid-column: 1 / -1; }
        label { font-size: 0.85rem; font-weight: 700; color: #444; }
        input, select, textarea { padding: 12px; border: 2px solid #eee; border-radius: 10px; font-family: inherit; font-size: 0.95rem; }
        input:focus { border-color: #e30613; outline: none; }
        .btn { padding: 12px 30px; border-radius: 10px; font-weight: 700; cursor: pointer; border: none; text-decoration: none; }
        .btn-primary { background: #e30613; color: white; }
    </style>
</head>
<body>

<div class="sidebar"></div>
<div class="main">
    <div class="topbar">
        <a href="{{ route('admin.inventory.index') }}" style="color: #888;"><i class="fas fa-arrow-left"></i> Kembali</a>
        <h1 style="font-size: 1.5rem; font-weight: 800;">Tambah Aset Baru</h1>
    </div>

    <div class="form-card">
        <form action="{{ route('admin.inventory.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-grid">
                <div class="form-group full">
                    <label>Nama Barang / Aset *</label>
                    <input type="text" name="name" required placeholder="Contoh: Proyektor Epson EB-X400">
                </div>
                <div class="form-group">
                    <label>Kode Aset (Opsional)</label>
                    <input type="text" name="asset_code" placeholder="Contoh: SMKA-ELEK-001">
                </div>
                <div class="form-group">
                    <label>Kategori *</label>
                    <select name="category" required>
                        <option value="Elektronik">Elektronik</option>
                        <option value="Mebel">Mebel / Perabot</option>
                        <option value="Alat Praktik">Alat Praktik</option>
                        <option value="Kendaraan">Kendaraan</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Lokasi / Ruangan *</label>
                    <input type="text" name="location" required placeholder="Contoh: Lab Komputer 1">
                </div>
                <div class="form-group">
                    <label>Jumlah Unit *</label>
                    <input type="number" name="quantity" value="1" required min="1">
                </div>
                <div class="form-group">
                    <label>Kondisi *</label>
                    <select name="condition">
                        <option value="baik">Baik / Normal</option>
                        <option value="rusak_ringan">Rusak Ringan</option>
                        <option value="rusak_berat">Rusak Berat</option>
                    </select>
                </div>
                <div class="form-group full">
                    <label>Foto Aset</label>
                    <input type="file" name="photo" accept="image/*">
                </div>
                <div class="form-group full">
                    <label>Keterangan Tambahan</label>
                    <textarea name="description" rows="4" placeholder="Spesifikasi atau catatan tambahan..."></textarea>
                </div>
            </div>
            <div style="margin-top: 30px;">
                <button type="submit" class="btn btn-primary">Simpan Aset</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
