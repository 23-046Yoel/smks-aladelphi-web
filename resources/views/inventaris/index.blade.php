<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris & Fasilitas - SMKS Aladelphi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&family=Outfit:wght@600;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #fdfdfd; color: #333; }
        header { background: #e30613; padding: 15px 0; position: sticky; top: 0; z-index: 100; box-shadow: 0 4px 20px rgba(0,0,0,0.1); }
        .header-inner { max-width: 1200px; margin: 0 auto; padding: 0 30px; display: flex; align-items: center; justify-content: space-between; }
        .logo { display: flex; align-items: center; gap: 12px; text-decoration: none; color: white; font-family: 'Outfit', sans-serif; }
        .logo img { height: 45px; background: white; padding: 5px; border-radius: 10px; }
        .back-btn { color: white; text-decoration: none; font-weight: 700; font-size: 0.85rem; background: rgba(255,255,255,0.15); padding: 8px 20px; border-radius: 30px; transition: 0.3s; }
        .back-btn:hover { background: rgba(255,255,255,0.3); }

        /* Hero */
        .hero { background: linear-gradient(135deg, #1a1a2e 0%, #e30613 100%); padding: 100px 30px; text-align: center; color: white; }
        .hero h1 { font-family: 'Outfit', sans-serif; font-size: 3rem; font-weight: 800; margin-bottom: 15px; }
        .hero p { font-size: 1.1rem; color: rgba(255,255,255,0.8); max-width: 700px; margin: 0 auto; }

        .container { max-width: 1200px; margin: 0 auto; padding: 60px 30px; }
        
        /* Filter */
        .filters { display: flex; gap: 10px; margin-bottom: 40px; overflow-x: auto; padding-bottom: 10px; }
        .filter-btn { padding: 10px 25px; border-radius: 50px; background: white; border: 1px solid #eee; font-weight: 700; font-size: 0.9rem; cursor: pointer; transition: 0.3s; white-space: nowrap; }
        .filter-btn.active { background: #e30613; color: white; border-color: #e30613; }

        /* Grid */
        .inventory-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 30px; }
        .item-card { background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.03); border: 1px solid #f0f0f0; transition: 0.3s; }
        .item-card:hover { transform: translateY(-10px); box-shadow: 0 20px 40px rgba(0,0,0,0.08); }
        .item-img { width: 100%; height: 200px; object-fit: cover; background: #f5f5f5; }
        .item-placeholder { width: 100%; height: 200px; background: #eee; display: flex; align-items: center; justify-content: center; color: #ccc; font-size: 3rem; }
        .item-body { padding: 25px; }
        .item-cat { font-size: 0.7rem; font-weight: 800; color: #e30613; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 10px; display: block; }
        .item-name { font-size: 1.2rem; font-weight: 800; color: #1a1a2e; margin-bottom: 10px; }
        .item-meta { display: flex; flex-direction: column; gap: 8px; font-size: 0.85rem; color: #666; }
        .item-meta span { display: flex; align-items: center; gap: 8px; }
        .item-meta i { width: 16px; color: #e30613; }
        .condition-badge { display: inline-block; padding: 4px 12px; border-radius: 30px; font-size: 0.7rem; font-weight: 800; text-transform: uppercase; margin-top: 15px; }
        .badge-baik { background: #e6f7ed; color: #28a745; }
        .badge-rusak { background: #fdf2f2; color: #e30613; }

        footer { background: #1a1a2e; color: rgba(255,255,255,0.5); padding: 40px; text-align: center; font-size: 0.85rem; }
    </style>
</head>
<body>

<header>
    <div class="header-inner">
        <a href="{{ url('/') }}" class="logo">
            <img src="{{ asset('images/official_logo.png') }}" alt="Logo">
            <span>SMKS ALADELPHI</span>
        </a>
        <a href="{{ url('/') }}" class="back-btn"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
</header>

<div class="hero">
    <h1>Inventaris & Fasilitas</h1>
    <p>Daftar sarana prasarana dan fasilitas penunjang pendidikan berkualitas di SMKS Ala Delphi Tiga Binanga.</p>
</div>

<div class="container">
    <div class="filters">
        <button class="filter-btn active">Semua Aset</button>
        @foreach($categories as $cat)
            <button class="filter-btn">{{ $cat }}</button>
        @endforeach
    </div>

    @if($items->count() > 0)
    <div class="inventory-grid">
        @foreach($items as $item)
        <div class="item-card">
            @if($item->photo)
                <img src="{{ Storage::url($item->photo) }}" class="item-img" alt="{{ $item->name }}">
            @else
                <div class="item-placeholder"><i class="fas fa-boxes"></i></div>
            @endif
            <div class="item-body">
                <span class="item-cat">{{ $item->category }}</span>
                <h3 class="item-name">{{ $item->name }}</h3>
                <div class="item-meta">
                    <span><i class="fas fa-map-marker-alt"></i> {{ $item->location }}</span>
                    <span><i class="fas fa-layer-group"></i> Jumlah: {{ $item->quantity }} Unit</span>
                    @if($item->asset_code)
                        <span><i class="fas fa-barcode"></i> Kode: {{ $item->asset_code }}</span>
                    @endif
                </div>
                <div class="condition-badge badge-{{ $item->condition == 'baik' ? 'baik' : 'rusak' }}">
                    Kondisi: {{ str_replace('_', ' ', $item->condition) }}
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div style="text-align: center; padding: 100px 0; color: #aaa;">
        <i class="fas fa-box-open" style="font-size: 4rem; margin-bottom: 20px;"></i>
        <p>Belum ada data inventaris yang dipublikasikan.</p>
    </div>
    @endif
</div>

<footer>
    <p>&copy; 2026 SMK SWASTA ALA DELPHI - TIGA BINANGA</p>
</footer>

</body>
</html>
