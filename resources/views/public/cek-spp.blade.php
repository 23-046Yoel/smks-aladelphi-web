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
        .page-header {
            background: linear-gradient(135deg, #e30613 0%, #8a0000 100%);
            padding: 80px 20px;
            text-align: center;
            color: white;
            margin-bottom: 50px;
        }
        .page-header h1 {
            font-size: 2.5rem;
            margin: 0 0 10px;
        }
        .search-box {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.08);
            max-width: 600px;
            margin: -80px auto 40px;
            position: relative;
            z-index: 10;
            text-align: center;
        }
        .search-box input {
            width: 100%;
            padding: 15px 20px;
            font-size: 1.1rem;
            border: 2px solid #eee;
            border-radius: 12px;
            margin-bottom: 20px;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
            text-align: center;
        }
        .search-box input:focus {
            outline: none;
            border-color: #e30613;
        }
        .search-box button {
            background: #e30613;
            color: white;
            border: none;
            padding: 15px 40px;
            font-size: 1.1rem;
            font-weight: 800;
            border-radius: 12px;
            cursor: pointer;
            transition: 0.3s;
            width: 100%;
        }
        .search-box button:hover {
            background: #a00;
        }
        
        .result-container {
            max-width: 800px;
            margin: 0 auto 80px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            padding: 40px;
            border: 1px solid #eee;
        }
        .student-info {
            display: flex;
            align-items: center;
            gap: 20px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f5f5f5;
            margin-bottom: 30px;
        }
        .student-info .avatar {
            width: 70px;
            height: 70px;
            background: #f8f9fa;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: #ccc;
        }
        .student-info h3 {
            margin: 0 0 5px;
            font-size: 1.5rem;
            color: #1a1a1a;
        }
        .student-info p {
            margin: 0;
            color: #777;
            font-weight: 600;
        }
        
        .months-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
        }
        .month-card {
            border: 2px solid #eee;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            transition: 0.3s;
        }
        .month-card.paid {
            border-color: #28a745;
            background: rgba(40, 167, 69, 0.05);
        }
        .month-card.unpaid {
            border-color: #e30613;
            background: rgba(227, 6, 19, 0.05);
        }
        .month-card h4 {
            margin: 0 0 10px;
            font-size: 1.1rem;
        }
        .month-badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 800;
        }
        .badge-paid {
            background: #28a745;
            color: white;
        }
        .badge-unpaid {
            background: #e30613;
            color: white;
        }
        .date-paid {
            display: block;
            margin-top: 10px;
            font-size: 0.75rem;
            color: #777;
        }
        
        .alert-error {
            background: #ffe6e6;
            color: #e30613;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            font-weight: 600;
            max-width: 600px;
            margin: 0 auto 50px;
            border: 1px solid #ffcccc;
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

    <div class="page-header">
        <h1>Cek Status SPP Siswa</h1>
        <p>Pantau pembayaran administrasi sekolah putra/putri Anda secara transparan.</p>
    </div>

    <div class="search-box">
        <h2 style="margin-top:0;">Masukkan NIS Anda</h2>
        <form action="{{ route('public.cek-spp') }}" method="GET">
            <input type="text" name="nis" placeholder="Contoh: 10293847" value="{{ request('nis') }}" required>
            <button type="submit"><i class="fas fa-search"></i> Cari Data Siswa</button>
        </form>
    </div>

    @if(request()->has('nis') && !$student)
        <div class="alert-error">
            <i class="fas fa-exclamation-triangle"></i> Maaf, data siswa dengan NIS "{{ request('nis') }}" tidak ditemukan.
        </div>
    @endif

    @if($student)
    <div class="result-container">
        <div class="student-info">
            <div class="avatar"><i class="fas fa-user"></i></div>
            <div>
                <h3>{{ $student->name }}</h3>
                <p>NIS: {{ $student->nis }} | Kelas: {{ $student->class }} | Jurusan: {{ $student->major }}</p>
            </div>
        </div>
        
        <h3 style="margin-bottom: 20px;"><i class="fas fa-calendar-check"></i> Status Pembayaran Tahun {{ date('Y') }}</h3>
        
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
                        <span class="date-paid">Dibayar: {{ \Carbon\Carbon::parse($payment->payment_date)->format('d/m/Y') }}</span>
                    @else
                        <span class="month-badge badge-unpaid"><i class="fas fa-times"></i> BELUM</span>
                        <span class="date-paid">Tagihan: Rp {{ number_format($student->spp_amount, 0, ',', '.') }}</span>
                    @endif
                </div>
            @endforeach
        </div>
        
        <div style="margin-top: 40px; padding: 20px; background: #fff8e1; border-radius: 12px; border-left: 4px solid #ffc107;">
            <h4 style="margin: 0 0 10px; color: #b8860b;"><i class="fas fa-info-circle"></i> Informasi Pembayaran</h4>
            <p style="margin: 0; font-size: 0.9rem; color: #666; line-height: 1.6;">
                Pembayaran SPP dapat dilakukan secara langsung ke ruang Tata Usaha (Bendahara) atau melalui transfer ke Rekening Resmi SMKS Aladelphi:<br>
                <strong>Bank Mandiri: 123-456-789-0 a.n SMKS Aladelphi</strong><br>
                Harap segera konfirmasi ke WhatsApp Bendahara setelah melakukan transfer.
            </p>
        </div>
    </div>
    @endif

    <!-- Footer -->
    <footer style="background: #e30613; color: white; padding: 60px 0; text-align: center;">
        <p>&copy; 2026 SMK SWASTA ALA DELPHI - TIGA BINANGA. All rights reserved.</p>
    </footer>
</body>
</html>
