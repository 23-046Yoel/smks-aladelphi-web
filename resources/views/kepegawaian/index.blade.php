<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kepegawaian - SMK Swasta Ala Delphi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f8f9fa; color: #333; }

        /* HEADER */
        header { background: #e30613; padding: 15px 0; position: sticky; top: 0; z-index: 100; box-shadow: 0 3px 15px rgba(0,0,0,0.15); }
        .header-inner { max-width: 1200px; margin: 0 auto; padding: 0 30px; display: flex; align-items: center; justify-content: space-between; }
        .logo-area { display: flex; align-items: center; gap: 15px; text-decoration: none; }
        .logo-area img { height: 50px; background: white; padding: 5px; border-radius: 8px; }
        .logo-area h1 { color: white; font-size: 1.1rem; font-weight: 800; }
        .back-btn { color: white; text-decoration: none; font-weight: 600; font-size: 0.9rem; display: flex; align-items: center; gap: 8px; background: rgba(255,255,255,0.15); padding: 8px 18px; border-radius: 30px; transition: 0.3s; }
        .back-btn:hover { background: rgba(255,255,255,0.3); }

        /* HERO */
        .page-hero { background: linear-gradient(135deg, #1a1a1a 0%, #e30613 100%); padding: 80px 30px; text-align: center; color: white; }
        .page-hero h1 { font-size: 2.8rem; font-weight: 800; margin-bottom: 15px; }
        .page-hero p { font-size: 1.1rem; color: rgba(255,255,255,0.85); max-width: 600px; margin: 0 auto; }
        .hero-stats { display: flex; justify-content: center; gap: 60px; margin-top: 40px; }
        .hero-stat span { display: block; font-size: 2.5rem; font-weight: 800; color: #fffb00; }
        .hero-stat p { font-size: 0.85rem; text-transform: uppercase; letter-spacing: 2px; color: rgba(255,255,255,0.8); margin-top: 5px; }

        /* CONTENT */
        .container { max-width: 1200px; margin: 0 auto; padding: 0 30px; }
        .section { padding: 80px 0; }
        .section-header { display: flex; align-items: center; gap: 15px; margin-bottom: 40px; }
        .section-bar { width: 5px; height: 40px; background: #e30613; border-radius: 3px; }
        .section-header h2 { font-size: 1.8rem; font-weight: 800; color: #1a1a1a; }
        .section-header p { font-size: 0.85rem; color: #e30613; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; margin-top: 3px; }

        /* TABS */
        .tab-nav { display: flex; gap: 10px; margin-bottom: 40px; background: #fff; padding: 8px; border-radius: 50px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); width: fit-content; }
        .tab-btn { padding: 10px 28px; border: none; background: transparent; border-radius: 50px; font-weight: 700; cursor: pointer; font-size: 0.9rem; transition: 0.3s; color: #666; }
        .tab-btn.active { background: #e30613; color: white; }

        /* CARDS GRID */
        .cards-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 25px; }
        .emp-card { background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.06); transition: 0.3s; }
        .emp-card:hover { transform: translateY(-8px); box-shadow: 0 15px 40px rgba(227,6,19,0.12); }
        .emp-photo { width: 100%; height: 230px; object-fit: cover; object-position: top; background: #eee; display: block; }
        .emp-photo-placeholder { width: 100%; height: 230px; background: linear-gradient(135deg, #f0f0f0, #e0e0e0); display: flex; align-items: center; justify-content: center; }
        .emp-photo-placeholder i { font-size: 4rem; color: #ccc; }
        .emp-info { padding: 18px; border-top: 3px solid #e30613; }
        .emp-name { font-size: 1rem; font-weight: 800; color: #1a1a1a; margin-bottom: 5px; }
        .emp-position { font-size: 0.8rem; color: #e30613; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; }
        .emp-subject { font-size: 0.78rem; color: #888; margin-top: 4px; }

        /* EMPTY STATE */
        .empty-state { text-align: center; padding: 60px; color: #aaa; }
        .empty-state i { font-size: 3rem; margin-bottom: 15px; }

        /* FOOTER */
        footer { background: #1a1a1a; color: white; text-align: center; padding: 30px; font-size: 0.85rem; color: rgba(255,255,255,0.5); }
    </style>
</head>
<body>

<header>
    <div class="header-inner">
        <a href="{{ url('/') }}" class="logo-area">
            <img src="{{ asset('images/official_logo.png') }}" alt="Logo">
            <h1>SMK SWASTA ALA DELPHI</h1>
        </a>
        <a href="{{ url('/') }}" class="back-btn"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
</header>

<!-- HERO -->
<div class="page-hero">
    <h1>Tenaga Pendidik & Kependidikan</h1>
    <p>Mengenal para pendidik berdedikasi yang membentuk generasi unggul SMKS Ala Delphi Tiga Binanga</p>
    <div class="hero-stats">
        <div class="hero-stat">
            <span>{{ $guru->count() }}</span>
            <p>Guru Aktif</p>
        </div>
        <div class="hero-stat">
            <span>{{ $staff->count() }}</span>
            <p>Staff & TU</p>
        </div>
        <div class="hero-stat">
            <span>{{ $guru->count() + $staff->count() }}</span>
            <p>Total Pegawai</p>
        </div>
    </div>
</div>

<!-- CONTENT -->
<div class="container">
    <!-- GURU -->
    <div class="section">
        <div class="section-header">
            <div class="section-bar"></div>
            <div>
                <p>SMKS Ala Delphi Tiga Binanga</p>
                <h2>Tenaga Pendidik (Guru)</h2>
            </div>
        </div>

        @if($guru->count() > 0)
        <div class="cards-grid">
            @foreach($guru as $emp)
            <div class="emp-card">
                @if($emp->photo)
                    <img src="{{ Storage::url($emp->photo) }}" alt="{{ $emp->name }}" class="emp-photo">
                @else
                    <div class="emp-photo-placeholder"><i class="fas fa-user-tie"></i></div>
                @endif
                <div class="emp-info">
                    <div class="emp-name">{{ $emp->name }}</div>
                    <div class="emp-position">{{ $emp->position }}</div>
                    @if($emp->subject)
                    <div class="emp-subject"><i class="fas fa-book" style="margin-right:5px;"></i>{{ $emp->subject }}</div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="empty-state">
            <i class="fas fa-users"></i>
            <p>Belum ada data guru yang ditambahkan.</p>
        </div>
        @endif
    </div>

    <!-- STAFF & TU -->
    <div class="section" style="padding-top: 0;">
        <div class="section-header">
            <div class="section-bar"></div>
            <div>
                <p>SMKS Ala Delphi Tiga Binanga</p>
                <h2>Tenaga Kependidikan (Staff & TU)</h2>
            </div>
        </div>

        @if($staff->count() > 0)
        <div class="cards-grid">
            @foreach($staff as $emp)
            <div class="emp-card">
                @if($emp->photo)
                    <img src="{{ Storage::url($emp->photo) }}" alt="{{ $emp->name }}" class="emp-photo">
                @else
                    <div class="emp-photo-placeholder"><i class="fas fa-user"></i></div>
                @endif
                <div class="emp-info">
                    <div class="emp-name">{{ $emp->name }}</div>
                    <div class="emp-position">{{ $emp->position }}</div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="empty-state">
            <i class="fas fa-users-cog"></i>
            <p>Belum ada data staff yang ditambahkan.</p>
        </div>
        @endif
    </div>
</div>

<footer>
    <p>&copy; 2026 SMK Swasta Ala Delphi - Tiga Binanga. All rights reserved.</p>
</footer>

</body>
</html>
