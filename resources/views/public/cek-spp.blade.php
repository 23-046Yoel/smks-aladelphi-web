<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cek SPP Online | SMKS Aladelphi</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;600;800&family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body {
            background-color: #f8f9fc;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            margin: 0;
        }
        
        /* Premium Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            padding: 100px 20px 140px;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: radial-gradient(circle at 50% 0%, rgba(227, 6, 19, 0.15) 0%, transparent 70%);
        }
        .hero-section h1 {
            font-size: 3rem;
            margin: 0 0 15px;
            font-weight: 800;
            letter-spacing: -1px;
            position: relative;
            z-index: 2;
        }
        .hero-section p {
            font-size: 1.1rem;
            color: #cbd5e1;
            max-width: 600px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
            line-height: 1.6;
        }

        /* Sleek Search Box */
        .search-container {
            max-width: 700px;
            margin: -80px auto 60px;
            position: relative;
            z-index: 10;
            padding: 0 20px;
        }
        .search-box {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.1), 0 0 0 1px rgba(0,0,0,0.05);
            text-align: center;
        }
        .search-box h2 {
            margin: 0 0 25px;
            color: #1e293b;
            font-weight: 800;
            font-size: 1.5rem;
        }
        .search-input-group {
            display: flex;
            gap: 15px;
            margin-bottom: 10px;
        }
        @media (max-width: 600px) {
            .search-input-group { flex-direction: column; }
        }
        .search-box input {
            flex: 1;
            padding: 16px 25px;
            font-size: 1.1rem;
            border: 2px solid #e2e8f0;
            border-radius: 16px;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
            transition: 0.3s;
            background: #f8fafc;
            color: #334155;
        }
        .search-box input:focus {
            outline: none;
            border-color: #e30613;
            background: white;
            box-shadow: 0 0 0 4px rgba(227, 6, 19, 0.1);
        }
        .search-box button {
            background: #e30613;
            color: white;
            border: none;
            padding: 16px 35px;
            font-size: 1.1rem;
            font-weight: 700;
            border-radius: 16px;
            cursor: pointer;
            transition: 0.3s;
            box-shadow: 0 10px 15px -3px rgba(227, 6, 19, 0.3);
            white-space: nowrap;
        }
        .search-box button:hover {
            background: #cc0000;
            transform: translateY(-2px);
            box-shadow: 0 15px 20px -3px rgba(227, 6, 19, 0.4);
        }
        
        .main-content {
            flex: 1;
            padding: 0 20px 80px;
        }
        
        .result-container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 40px -15px rgba(0,0,0,0.05);
            padding: 40px;
            border: 1px solid #f1f5f9;
        }
        .student-info {
            display: flex;
            align-items: center;
            gap: 25px;
            padding-bottom: 25px;
            border-bottom: 2px solid #f1f5f9;
            margin-bottom: 35px;
        }
        .student-info .avatar {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: #94a3b8;
            box-shadow: inset 0 2px 4px rgba(255,255,255,0.5);
        }
        .student-info h3 {
            margin: 0 0 8px;
            font-size: 1.8rem;
            color: #0f172a;
            font-weight: 800;
        }
        .student-info p {
            margin: 0;
            color: #64748b;
            font-weight: 600;
            font-size: 1.05rem;
        }
        .student-info p span {
            color: #e30613;
            font-weight: 800;
        }
        
        .months-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }
        @media (max-width: 900px) {
            .months-grid { grid-template-columns: repeat(3, 1fr); }
        }
        @media (max-width: 600px) {
            .months-grid { grid-template-columns: repeat(2, 1fr); }
        }
        
        .month-card {
            border: 2px solid #f1f5f9;
            border-radius: 16px;
            padding: 25px 15px;
            text-align: center;
            transition: 0.3s;
            background: white;
            position: relative;
            overflow: hidden;
        }
        .month-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        }
        .month-card.paid {
            border-color: #10b981;
            background: #f0fdf4;
        }
        .month-card.paid::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 4px; background: #10b981;
        }
        .month-card.unpaid {
            border-color: #f1f5f9;
            background: #ffffff;
        }
        .month-card.unpaid::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0; height: 4px; background: #e30613;
        }
        
        .month-card h4 {
            margin: 0 0 15px;
            font-size: 1.15rem;
            color: #334155;
            font-weight: 700;
        }
        .month-badge {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 800;
            letter-spacing: 0.5px;
        }
        .badge-paid { background: #10b981; color: white; }
        .badge-unpaid { background: #fee2e2; color: #ef4444; }
        
        .date-paid {
            display: block;
            margin-top: 15px;
            font-size: 0.8rem;
            color: #64748b;
            font-weight: 600;
        }
        
        .alert-error {
            background: #fef2f2;
            color: #b91c1c;
            padding: 20px;
            border-radius: 16px;
            text-align: center;
            font-weight: 600;
            max-width: 600px;
            margin: 0 auto 50px;
            border: 1px solid #fecaca;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
        }

        .info-box {
            margin-top: 50px; 
            padding: 30px; 
            background: #f8fafc; 
            border-radius: 20px; 
            border: 1px solid #e2e8f0;
            display: flex;
            gap: 20px;
            align-items: flex-start;
        }
        .info-icon {
            width: 50px; height: 50px;
            background: white; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.5rem; color: #e8b31a;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
            flex-shrink: 0;
        }
        
        /* Modern Footer */
        .modern-footer {
            background: #0f172a;
            color: #94a3b8;
            padding: 30px 20px;
            text-align: center;
            font-size: 0.9rem;
            border-top: 1px solid #1e293b;
        }
    </style>
</head>
<body>
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="top-bar-info">
            <span><i class="fas fa-phone-alt"></i> +62 812-3456-7890</span>
            <span><i class="fas fa-envelope"></i> info@aladelphi.sch.id</span>
            <span><i class="fas fa-map-marker-alt"></i> Tiga Binanga, Indonesia</span>
        </div>
        <div class="top-bar-social">
            🌐 ID | EN
        </div>
    </div>

    <!-- Header -->
    <header>
        <div class="logo">
            <img src="{{ asset('images/official_logo.png') }}" alt="Logo SMK Ala Delphi" style="height: 100px; width: auto;">
            <div class="logo-text">
                <h1>SMK SWASTA ALA DELPHI</h1>
                <span>TIGA BINANGA</span>
            </div>
        </div>
        <nav>
            <ul>
                <li><a href="{{ url('/') }}">Beranda</a></li>
                <li class="dropdown">
                    <a href="#" class="dropbtn">Tentang Kami <i class="fas fa-chevron-down" style="font-size: 0.7rem; margin-left: 5px;"></i></a>
                    <div class="dropdown-content">
                        <a href="{{ route('about.visi-misi') }}"><i class="fas fa-bullseye"></i> Visi & Misi</a>
                        <a href="{{ route('kepegawaian.index') }}"><i class="fas fa-users"></i> Direktori Pegawai</a>
                    </div>
                </li>
                <li><a href="#">Jurusan</a></li>
                <li><a href="{{ route('public.cek-spp') }}">Cek SPP</a></li>
                <li><a href="{{ route('spmb.index') }}">SPMB ONLINE SMKS ALADELPHI</a></li>
                <li><a href="#">Kontak</a></li>
            </ul>
        </nav>
        <a href="{{ url('/login') }}" class="btn-primary">LOGIN</a>
    </header>

    <div class="hero-section">
        <h1>Cek Status SPP Siswa</h1>
        <p>Pantau tagihan dan riwayat pembayaran administrasi sekolah putra/putri Anda secara transparan dan terpadu.</p>
    </div>

    <div class="main-content">
        <div class="search-container">
            <div class="search-box">
                <h2>Masukkan Nomor Induk Siswa</h2>
                <form action="{{ route('public.cek-spp') }}" method="GET">
                    <div class="search-input-group">
                        <input type="text" name="nis" placeholder="Contoh: 10293847" value="{{ request('nis') }}" required>
                        <button type="submit"><i class="fas fa-search"></i> Cek Data</button>
                    </div>
                </form>
            </div>
        </div>

    @if(request()->has('nis') && !$student)
        <div class="alert-error">
            <i class="fas fa-exclamation-triangle" style="font-size: 1.5rem; display: block; margin-bottom: 10px;"></i> 
            Maaf, data siswa dengan NIS <strong>"{{ request('nis') }}"</strong> tidak ditemukan dalam sistem.
        </div>
    @endif

    @if($student)
        <div class="result-container">
            <div class="student-info">
                <div class="avatar"><i class="fas fa-user-graduate"></i></div>
                <div>
                    <h3>{{ $student->name }}</h3>
                    <p>NIS: <span>{{ $student->nis }}</span> &nbsp;|&nbsp; Kelas: <span>{{ $student->class }}</span> &nbsp;|&nbsp; Jurusan: <span>{{ $student->major }}</span></p>
                </div>
            </div>
            
            <h3 style="margin-bottom: 25px; color: #1e293b; font-size: 1.4rem; display: flex; align-items: center; gap: 10px;">
                <i class="fas fa-calendar-check" style="color: #10b981;"></i> Status Pembayaran Tahun {{ date('Y') }}
            </h3>
            
            <div class="months-grid">
                @php
                    $months = [
                        1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
                        4 => 'April', 5 => 'Mei', 6 => 'Juni',
                        7 => 'Juli', 8 => 'Agustus', 9 => 'September',
                        10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                    ];
                @endphp
                
                @foreach($months as $num => $name)
                    @php
                        $isPaid = isset($payments[$num]) && $payments[$num]->status == 'paid';
                        $payment = $payments[$num] ?? null;
                    @endphp
                    <div class="month-card {{ $isPaid ? 'paid' : 'unpaid' }}">
                        <h4>{{ $name }}</h4>
                        @if($isPaid)
                            <span class="month-badge badge-paid"><i class="fas fa-check"></i> LUNAS</span>
                            <span class="date-paid">Tgl: {{ \Carbon\Carbon::parse($payment->payment_date)->format('d/m/Y') }}</span>
                        @else
                            <span class="month-badge badge-unpaid"><i class="fas fa-clock"></i> BELUM</span>
                            <span class="date-paid">Rp {{ number_format($student->spp_amount, 0, ',', '.') }}</span>
                        @endif
                    </div>
                @endforeach
            </div>
            
            <div class="info-box">
                <div class="info-icon"><i class="fas fa-wallet"></i></div>
                <div>
                    <h4 style="margin: 0 0 8px; color: #0f172a; font-size: 1.1rem; font-weight: 800;">Informasi Pembayaran Resmi</h4>
                    <p style="margin: 0; font-size: 0.95rem; color: #475569; line-height: 1.7;">
                        Pembayaran SPP yang sah hanya dapat dilakukan secara langsung di <strong>Ruang Tata Usaha (Bendahara Sekolah)</strong> atau melalui transfer resmi ke:<br>
                        <strong style="color: #0f172a; background: #e2e8f0; padding: 3px 8px; border-radius: 6px; display: inline-block; margin-top: 5px;">Bank Mandiri: 123-456-789-0 a.n SMKS Aladelphi</strong><br>
                        <span style="font-size: 0.85rem; color: #e30613; margin-top: 5px; display: block;">*Harap berhati-hati terhadap penipuan yang mengatasnamakan sekolah.</span>
                    </p>
                </div>
            </div>
        </div>
    @endif
    </div>

    <!-- Footer -->
    <footer class="modern-footer">
        <p style="margin:0;">&copy; {{ date('Y') }} SMK SWASTA ALA DELPHI - TIGA BINANGA. Dikelola oleh Tim IT.</p>
    </footer>
</body>
</html>
