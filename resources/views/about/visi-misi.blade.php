<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Visi & Misi | SMKS Aladelphi</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;600;800&family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .about-hero {
            height: 400px;
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset('images/hero.png') }}');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
        }
        .hero-quote {
            font-size: 3rem;
            color: rgba(255,255,255,0.5);
            margin-bottom: 10px;
        }
        .hero-text {
            font-size: 2.5rem;
            font-weight: 800;
        }

        .visi-section {
            background: #007bff;
            color: white;
            padding: 100px 0;
            position: relative;
            text-align: center;
        }
        .visi-section::before {
            content: "";
            position: absolute;
            top: -50px;
            left: 0;
            width: 100%;
            height: 100px;
            background: white;
            border-radius: 0 0 50% 50% / 0 0 100% 100%;
        }
        .visi-section::after {
            content: "";
            position: absolute;
            bottom: -50px;
            left: 0;
            width: 100%;
            height: 100px;
            background: #007bff;
            border-radius: 0 0 50% 50% / 0 0 100% 100%;
            z-index: 1;
        }
        .visi-content {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .misi-section {
            padding: 150px 0;
            background: #fff;
        }
        .misi-grid {
            display: grid;
            grid-template-columns: 1.1fr 0.9fr; /* Ukuran gambar sedikit lebih besar */
            gap: 80px;
            align-items: center; /* Menyejajarkan secara vertikal ke tengah */
        }
        .misi-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .misi-list li {
            margin-bottom: 25px;
            display: flex;
            align-items: flex-start;
            gap: 18px;
            line-height: 1.6;
            font-size: 1.05rem;
            color: #444;
        }
        .misi-list li i {
            color: #007bff;
            font-size: 1.2rem;
            margin-top: 3px;
            flex-shrink: 0;
        }
        .misi-img-container {
            position: relative;
        }
        .misi-img-main {
            width: 100%;
            border-radius: 40px;
            box-shadow: 0 30px 60px rgba(0,0,0,0.1);
            position: relative;
            z-index: 2;
        }
        .misi-img-sub {
            width: 70%;
            border-radius: 30px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
            position: absolute;
            bottom: -60px;
            right: -30px;
            z-index: 1;
            border: 10px solid white;
        }

        .tujuan-section {
            padding: 80px 0;
            background: #f8f9fa;
        }
        .tujuan-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }
        .tujuan-card {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.02);
            transition: 0.3s;
        }
        .tujuan-card:hover { transform: translateY(-10px); }
        .tujuan-card i {
            font-size: 2rem;
            color: #e30613;
            margin-bottom: 20px;
            display: block;
        }
    </style>
</head>
<body>
    <header style="background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        <div class="logo">
            <img src="{{ asset('images/official_logo.png') }}" alt="Logo" style="height: 60px;">
            <div class="logo-text">
                <h1 style="font-size: 1.2rem; color: #1a1a1a;">SMK SWASTA ALA DELPHI</h1>
            </div>
        </div>
        <nav>
            <ul>
                <li><a href="{{ url('/') }}">Beranda</a></li>
                <li><a href="{{ route('spmb.index') }}">SPMB ONLINE</a></li>
            </ul>
        </nav>
    </header>

    <section class="about-hero">
        <div class="container">
            <div class="hero-quote"><i class="fas fa-quote-left"></i></div>
            <h2 class="hero-text">Membentuk Siswa Yang Berkarakter</h2>
        </div>
    </section>

    <section class="visi-section">
        <div class="visi-content">
            <h3 style="text-transform: uppercase; letter-spacing: 3px; margin-bottom: 20px;">Visi</h3>
            <p style="font-size: 1.5rem; line-height: 1.8; font-style: italic;">
                "Terwujudnya generasi penerus bangsa yang terampil dan handal yang mampu menyelaraskan antara kemajuan IPTEK dan IMTAQ serta sanggup bersaing di era globalisasi."
            </p>
        </div>
    </section>

    <section class="misi-section">
        <div class="container">
            <div class="misi-grid">
                <div class="misi-img-container">
                    <img src="{{ asset('images/hero.png') }}" class="misi-img-main" alt="Misi Utama">
                    <img src="{{ asset('images/hero.png') }}" class="misi-img-sub" alt="Misi Pendukung">
                </div>
                <div>
                    <h3 style="font-size: 2.8rem; margin-bottom: 40px; color: #1a1a1a; font-weight: 800;">Misi Kami</h3>
                    <ul class="misi-list">
                        <li><i class="fas fa-check-circle"></i> <span>Menanamkan keimanan dan ketakwaan melalui pengamalan ajaran agama.</span></li>
                        <li><i class="fas fa-check-circle"></i> <span>Menciptakan lingkungan sekolah yang sehat untuk mendukung optimasi kegiatan belajar mengajar.</span></li>
                        <li><i class="fas fa-check-circle"></i> <span>Membangun integritas, etos kerja dan jiwa gotong royong pada setiap warga sekolah.</span></li>
                        <li><i class="fas fa-check-circle"></i> <span>Melaksanakan aktifitas belajar yang berpusat pada siswa dalam suasana yang menyenangkan.</span></li>
                        <li><i class="fas fa-check-circle"></i> <span>Mengembangkan bidang Ilmu Pengetahuan dan Teknologi berdasarkan minat, bakat dan potensi peserta didik.</span></li>
                        <li><i class="fas fa-check-circle"></i> <span>Melaksanakan kerjasama yang harmonis dengan masyarakat dan DU/DI dalam rangka pemasaran tamatan.</span></li>
                        <li><i class="fas fa-check-circle"></i> <span>Menumbuhkan sikap mandiri dan berjiwa wirausaha.</span></li>
                        <li><i class="fas fa-check-circle"></i> <span>Memahami dengan toleransi tinggi sehingga dapat mengaplikasikan ilmunya dalam kehidupan berbangsa dan bernegara.</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="tujuan-section">
        <div class="container">
            <div style="text-align: center; margin-bottom: 50px;">
                <h2 style="font-size: 2.5rem;">Tujuan Pendidikan</h2>
                <p style="color: #666;">Target dan sasaran kualitas lulusan SMKS Ala Delphi</p>
            </div>
            <div class="tujuan-grid">
                <div class="tujuan-card">
                    <i class="fas fa-graduation-cap"></i>
                    <p>Memberikan pendidikan dan pelatihan untuk Kompetensi Keahlian Teknik Komputer dan Jaringan serta Teknik Bisnis dan Sepeda Motor agar memiliki keahlian di bidangnya.</p>
                </div>
                <div class="tujuan-card">
                    <i class="fas fa-lightbulb"></i>
                    <p>Menjadi wirausaha yang mahir di bidang kompetensi keahlian TKJ dan TBSM setelah lulus dari SMK SWASTA ALA DELPHI TIGABINANGA.</p>
                </div>
                <div class="tujuan-card">
                    <i class="fas fa-briefcase"></i>
                    <p>Mengutamakan penyiapan siswa untuk memenuhi lapangan kerja serta mengembangkan sikap professional.</p>
                </div>
                <div class="tujuan-card">
                    <i class="fas fa-globe"></i>
                    <p>Agar tamatan mempunyai peluang yang semakin besar untuk memasuki lapangan kerja di dalam dan di luar negeri.</p>
                </div>
                <div class="tujuan-card">
                    <i class="fas fa-user-shield"></i>
                    <p>Agar tamatan memiliki bekal yang kuat untuk berhasil dalam melakukan usaha mandiri.</p>
                </div>
                <div class="tujuan-card">
                    <i class="fas fa-chart-line"></i>
                    <p>Menyiapkan siswa agar mampu memilih karir, mampu berkompetensi dan mampu mengembangkan diri.</p>
                </div>
                <div class="tujuan-card">
                    <i class="fas fa-users"></i>
                    <p>Menyiapkan tenaga kerja tingkat menengah untuk mengisi dunia usaha dan dunia industry saat ini maupun masa depan.</p>
                </div>
                <div class="tujuan-card">
                    <i class="fas fa-heart"></i>
                    <p>Menyiapkan tamatan agar menjadi warga Negara yang produktif, adaktif, dan kreatif.</p>
                </div>
            </div>
        </div>
    </section>

    <footer style="background: #e30613; color: white; padding: 80px 0; margin-top: 50px;">
        <div class="container">
            <div style="display: grid; grid-template-columns: 1.2fr 1fr 0.8fr; gap: 60px; align-items: start;">
                <!-- Section Logo -->
                <div class="footer-section">
                    <img src="{{ asset('images/official_logo.png') }}" alt="Logo SMK Ala Delphi" style="height: 100px; width: auto; margin-bottom: 25px; background: white; padding: 10px; border-radius: 15px;">
                    <h3 style="color: white; font-size: 1.5rem; margin-bottom: 15px;">SMK SWASTA ALA DELPHI</h3>
                    <p style="color: rgba(255,255,255,0.9); line-height: 1.6; font-size: 0.95rem;">Mencetak lulusan unggul, kompeten, dan berintegritas tinggi untuk masa depan Indonesia.</p>
                </div>

                <!-- Section Kontak -->
                <div class="footer-section">
                    <h3 style="color: #fffb00; font-size: 1.4rem; margin-bottom: 30px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px;">Kontak Kami</h3>
                    <div style="display: flex; flex-direction: column; gap: 25px;">
                        
                        <!-- Alamat Sejajar Sempurna -->
                        <div style="display: flex; align-items: flex-start; gap: 20px;">
                            <div style="min-width: 45px; height: 45px; background: rgba(255,255,255,0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #fffb00; font-size: 1.2rem;">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div style="flex: 1;">
                                <h4 style="margin: 0 0 5px 0; color: #fffb00; font-size: 1.1rem; font-weight: 700;">SMK Swasta Ala Delphi</h4>
                                <p style="margin: 0; line-height: 1.7; color: rgba(255,255,255,0.9); font-size: 1rem;">
                                    Jln Juhar komplek SMK Ala Delphi no 1<br>
                                    Kecamatan Tiga Binanga, Kab Karo
                                </p>
                            </div>
                        </div>

                        <!-- Telepon -->
                        <div style="display: flex; align-items: center; gap: 20px;">
                            <div style="min-width: 45px; height: 45px; background: rgba(255,255,255,0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #fffb00; font-size: 1.2rem;">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <p style="margin: 0; font-size: 1.05rem; font-weight: 600;">+62 812-3456-7890</p>
                        </div>

                        <!-- Email -->
                        <div style="display: flex; align-items: center; gap: 20px;">
                            <div style="min-width: 45px; height: 45px; background: rgba(255,255,255,0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #fffb00; font-size: 1.2rem;">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <p style="margin: 0; font-size: 1.05rem; font-weight: 600;">info@aladelphi.sch.id</p>
                        </div>

                    </div>
                </div>

                <!-- Section Link -->
                <div class="footer-section">
                    <h3 style="color: #fffb00; font-size: 1.3rem; margin-bottom: 25px; border-bottom: 2px solid rgba(255,255,255,0.2); display: inline-block; padding-bottom: 5px;">Tautan Cepat</h3>
                    <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 12px;">
                        <li><a href="{{ route('spmb.index') }}" style="color: white; text-decoration: none; transition: 0.3s;"><i class="fas fa-chevron-right" style="font-size: 0.7rem; margin-right: 8px;"></i> PPDB Online</a></li>
                        <li><a href="{{ url('/') }}" style="color: white; text-decoration: none; transition: 0.3s;"><i class="fas fa-chevron-right" style="font-size: 0.7rem; margin-right: 8px;"></i> Beranda</a></li>
                        <li><a href="#" style="color: white; text-decoration: none; transition: 0.3s;"><i class="fas fa-chevron-right" style="font-size: 0.7rem; margin-right: 8px;"></i> Kontak Kami</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div style="border-top: 1px solid rgba(255,255,255,0.1); margin-top: 60px; padding-top: 30px; text-align: center;">
            <p style="color: rgba(255,255,255,0.7); font-size: 0.85rem;">&copy; 2026 SMK SWASTA ALA DELPHI - TIGA BINANGA. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
