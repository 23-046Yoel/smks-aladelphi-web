<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Aset - Admin</title>
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
        <h1 style="font-size: 1.5rem; font-weight: 800;">Edit Data Aset</h1>
    </div>

    <div class="form-card">
        <form action="{{ route('admin.inventory.update', $inventory->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="form-grid">
                <div class="form-group full">
                    <label>Nama Barang / Aset *</label>
                    <input type="text" name="name" value="{{ $inventory->name }}" required>
                </div>
                <div class="form-group">
                    <label>Kode Aset</label>
                    <input type="text" name="asset_code" value="{{ $inventory->asset_code }}">
                </div>
                <div class="form-group">
                    <label>Kategori *</label>
                    <select name="category" required>
                        <option value="Elektronik" {{ $inventory->category == 'Elektronik' ? 'selected' : '' }}>Elektronik</option>
                        <option value="Mebel" {{ $inventory->category == 'Mebel' ? 'selected' : '' }}>Mebel / Perabot</option>
                        <option value="Alat Praktik" {{ $inventory->category == 'Alat Praktik' ? 'selected' : '' }}>Alat Praktik</option>
                        <option value="Kendaraan" {{ $inventory->category == 'Kendaraan' ? 'selected' : '' }}>Kendaraan</option>
                        <option value="Lainnya" {{ $inventory->category == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Lokasi / Ruangan *</label>
                    <input type="text" name="location" value="{{ $inventory->location }}" required>
                </div>
                <div class="form-group">
                    <label>Jumlah Unit *</label>
                    <input type="number" name="quantity" value="{{ $inventory->quantity }}" required min="1">
                </div>
                <div class="form-group">
                    <label>Kondisi *</label>
                    <select name="condition">
                        <option value="baik" {{ $inventory->condition == 'baik' ? 'selected' : '' }}>Baik / Normal</option>
                        <option value="rusak_ringan" {{ $inventory->condition == 'rusak_ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                        <option value="rusak_berat" {{ $inventory->condition == 'rusak_berat' ? 'selected' : '' }}>Rusak Berat</option>
                    </select>
                </div>
                <div class="form-group full">
                    <label>Foto Aset (Biarkan kosong jika tidak ingin mengganti)</label>
                    @if($inventory->photo)
                        <img src="{{ Storage::url($inventory->photo) }}" style="width: 100px; height: 100px; border-radius: 10px; object-fit: cover; margin-bottom: 10px; display: block;">
                    @endif
                    <input type="file" name="photo" accept="image/*">
                </div>
                <div class="form-group full">
                    <label>Keterangan Tambahan</label>
                    <textarea name="description" rows="4">{{ $inventory->description }}</textarea>
                </div>
            </div>
            <div style="margin-top: 30px;">
                <button type="submit" class="btn btn-primary">Update Data Aset</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
