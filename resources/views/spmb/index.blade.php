<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SPMB Online | SMKS Aladelphi</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #e30613;
            --secondary: #c5a059;
            --dark: #1a1a2e;
            --light: #f8f9fa;
        }

        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background: #fff;
        }

        h1, h2, h3, .brand {
            font-family: 'Outfit', sans-serif;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header */
        header {
            padding: 20px 0;
            background: #fff;
            border-bottom: 1px solid #eee;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 15px;
            text-decoration: none;
        }

        .logo img {
            height: 50px;
        }

        .logo-text h1 {
            font-size: 1.2rem;
            margin: 0;
            color: var(--dark);
            font-weight: 800;
        }

        .nav-btns {
            display: flex;
            gap: 15px;
        }

        .btn {
            padding: 10px 25px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            font-size: 0.9rem;
            transition: 0.3s;
        }

        .btn-outline {
            border: 2px solid var(--primary);
            color: var(--primary);
        }

        .btn-primary {
            background: var(--primary);
            color: #fff;
        }

        /* Hero */
        .hero {
            padding: 80px 0;
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 50px;
            align-items: center;
        }

        .hero-text h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            line-height: 1.1;
        }

        .hero-text h1 span {
            color: var(--secondary);
        }

        .hero-text p {
            font-size: 1.1rem;
            color: #666;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .hero-img {
            position: relative;
        }

        .hero-img img {
            width: 100%;
            border-radius: 30px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.1);
        }

        /* Registration Banner */
        .reg-banner {
            background: linear-gradient(rgba(26, 26, 46, 0.9), rgba(26, 26, 46, 0.9)), url('/images/spmb_hero.png');
            background-size: cover;
            background-position: center;
            padding: 80px 0;
            color: #fff;
            text-align: left;
        }

        .reg-banner-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .reg-title h2 {
            font-size: 2.5rem;
            margin: 0;
            text-transform: uppercase;
        }

        .reg-info {
            text-align: right;
        }

        .reg-info p {
            color: var(--secondary);
            font-weight: 700;
            margin-bottom: 10px;
            font-size: 1.1rem;
        }

        .reg-info h3 {
            font-size: 1.8rem;
            margin: 0;
        }

        /* Requirements */
        .requirements {
            padding: 100px 0;
            text-align: center;
        }

        .requirements h2 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            color: var(--dark);
        }

        .requirements p.subtitle {
            color: #666;
            margin-bottom: 60px;
        }

        .req-list {
            text-align: left;
            max-width: 900px;
            margin: 0 auto;
            counter-reset: req-counter;
        }

        .req-item {
            margin-bottom: 25px;
            padding-left: 50px;
            position: relative;
            font-size: 1.05rem;
            line-height: 1.6;
            color: #444;
        }

        .req-item::before {
            counter-increment: req-counter;
            content: counter(req-counter) ".";
            position: absolute;
            left: 0;
            color: var(--secondary);
            font-weight: 800;
            font-size: 1.2rem;
        }

        /* Timeline */
        .timeline-section {
            padding: 100px 0;
            background: #fff;
            text-align: center;
        }

        .timeline-section h2 {
            font-size: 2.2rem;
            margin-bottom: 60px;
        }

        .timeline-path {
            display: flex;
            justify-content: space-between;
            position: relative;
            max-width: 1000px;
            margin: 0 auto 80px;
        }

        .timeline-path::after {
            content: '';
            position: absolute;
            top: 25px;
            left: 5%;
            right: 5%;
            height: 6px;
            background: #eee;
            z-index: 1;
            border-radius: 3px;
        }

        .timeline-step {
            position: relative;
            z-index: 2;
            width: 150px;
        }

        .step-dot {
            width: 50px;
            height: 50px;
            background: #fff;
            border: 6px solid var(--primary);
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            color: var(--primary);
        }

        .timeline-step.active .step-dot {
            background: var(--primary);
            color: #fff;
        }

        .step-label {
            font-weight: 700;
            font-size: 0.9rem;
            color: var(--dark);
        }

        .footer-cta {
            padding: 60px 0;
            text-align: center;
        }

        .btn-large {
            padding: 18px 60px;
            font-size: 1.2rem;
            background: var(--dark);
            color: #fff;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 800;
            transition: 0.3s;
            display: inline-block;
        }

        .btn-large:hover {
            transform: scale(1.05);
            background: var(--primary);
        }

        footer {
            padding: 40px 0;
            background: #fff;
            border-top: 1px solid #eee;
            text-align: center;
            color: #888;
            font-size: 0.9rem;
        }

        @media (max-width: 768px) {
            .hero { grid-template-columns: 1fr; text-align: center; }
            .reg-banner-inner { flex-direction: column; text-align: center; gap: 30px; }
            .reg-info { text-align: center; }
            .timeline-path { flex-direction: column; gap: 40px; }
            .timeline-path::after { display: none; }
        }
    </style>
</head>
<body>

<header>
    <div class="container">
        <div class="header-inner">
            <a href="{{ url('/') }}" class="logo">
                <img src="{{ asset('images/official_logo.png') }}" alt="Logo">
                <div class="logo-text">
                    <h1>SMKS ALA DELPHI</h1>
                </div>
            </a>
            <div class="nav-btns">
                <a href="{{ url('/') }}" class="btn btn-outline">KEMBALI KE BERANDA</a>
                <a href="{{ url('/login') }}" class="btn btn-primary">LOGIN PORTAL</a>
            </div>
        </div>
    </div>
</header>

<div class="container">
    <section class="hero">
        <div class="hero-text">
            <h1>SPMB <span>SMKS ALA DELPHI</span></h1>
            <p>Selamat datang di PPDB atau sekarang disebut <strong>Sistem Penerimaan Murid Baru (SPMB)</strong> TA 2026/2027 SMKS Ala Delphi. Pada SPMB online tahun ini, sekolah membuka kesempatan bagi calon peserta didik terbaik dari berbagai penjuru tanah air.</p>
            <a href="#syarat" class="btn btn-primary" style="padding: 12px 30px;">Cek Selengkapnya →</a>
        </div>
        <div class="hero-img">
            <img src="{{ asset('images/spmb_hero.png') }}" alt="Siswa SMK Ala Delphi">
        </div>
    </section>
</div>

<section class="reg-banner">
    <div class="container">
        <div class="reg-banner-inner">
            <div class="reg-title">
                <h2>REGISTRASI<br>SPMB ALADELPHI</h2>
            </div>
            <div class="reg-info">
                <p>Periode Pendaftaran</p>
                <h3>1 DESEMBER 2025 – 18 JANUARI 2026</h3>
                <p style="margin-top: 20px; color: rgba(255,255,255,0.7); font-weight: 400; font-size: 0.9rem;">Yakin, kalian lolos SPMB dan jadi siswa SMKS Ala Delphi. Mestakung, semesta mendukung!</p>
            </div>
        </div>
    </div>
</section>

<section class="requirements" id="syarat">
    <div class="container">
        <h2>Syarat & Ketentuan Umum Peserta SPMB</h2>
        <p class="subtitle">Seluruh peserta SPMB wajib memenuhi syarat & ketentuan umum di bawah ini:</p>
        
        <div class="req-list">
            <div class="req-item">Warga Negara Indonesia (WNI), laki-laki dan perempuan.</div>
            <div class="req-item">Lulus SMP/sederajat tahun pelajaran 2025/2026.</div>
            <div class="req-item">Tidak pernah tinggal kelas selama di SMP/sederajat.</div>
            <div class="req-item">
                <strong>Nilai Rapor:</strong>
                <ul style="list-style: disc; padding-left: 20px; margin-top: 10px;">
                    <li>Sekolah nasional, nilai rata-rata rapor semester I s.d. V untuk mata pelajaran Bahasa Inggris, Matematika dan IPA minimal 85.</li>
                    <li>Berkelakuan baik yang dibuktikan surat keterangan dari kepala sekolah asal.</li>
                </ul>
            </div>
            <div class="req-item">Memiliki kondisi kesehatan yang baik dan tidak buta warna (untuk jurusan tertentu).</div>
            <div class="req-item">Persetujuan tertulis di atas materai oleh orang tua/wali dan peserta untuk bersedia mengikuti seluruh proses seleksi.</div>
            <div class="req-item">Seluruh calon siswa (casis) dari semua jalur wajib mengikuti seleksi daerah dan seleksi pusat.</div>
        </div>
    </div>
</section>

<section class="timeline-section">
    <div class="container">
        <h2>Timeline dan Tahapan SPMB<br>SMKS Ala Delphi</h2>
        
        <div class="timeline-path">
            <div class="timeline-step active">
                <div class="step-dot">01</div>
                <div class="step-label">PENDAFTARAN ONLINE</div>
                <div style="font-size: 0.75rem; color: #888; margin-top: 5px;">DES 2025 - JAN 2026</div>
            </div>
            <div class="timeline-step">
                <div class="step-dot">02</div>
                <div class="step-label">VERIFIKASI BERKAS</div>
                <div style="font-size: 0.75rem; color: #888; margin-top: 5px;">JANUARI 2026</div>
            </div>
            <div class="timeline-step">
                <div class="step-dot">03</div>
                <div class="step-label">SELEKSI AKADEMIK</div>
                <div style="font-size: 0.75rem; color: #888; margin-top: 5px;">FEBRUARI 2026</div>
            </div>
            <div class="timeline-step">
                <div class="step-dot">04</div>
                <div class="step-label">PENGUMUMAN</div>
                <div style="font-size: 0.75rem; color: #888; margin-top: 5px;">MARET 2026</div>
            </div>
        </div>

        <div class="footer-cta">
            <a href="{{ route('spmb.create') }}" class="btn-large">DAFTAR SEKARANG</a>
        </div>
    </div>
</section>

<footer>
    <div class="container">
        <p>&copy; 2026 SMK SWASTA ALA DELPHI TIGA BINANGA. All rights reserved.</p>
    </div>
</footer>

<script>
    // Smooth scroll for anchors
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
</script>

</body>
</html>
