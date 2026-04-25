<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SMKS Aladelphi | Excellence in Education</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;600;800&family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
    </div    <!-- Header -->
    <header>
        <div class="logo">
            <!-- Official School Logo Image -->
            <img src="{{ asset('images/official_logo.png') }}" alt="Logo SMK Ala Delphi" style="height: 100px; width: auto; filter: none;">
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
                        <a href="#"><i class="fas fa-history"></i> Sejarah Sekolah</a>
                        <a href="#"><i class="fas fa-user-tie"></i> Struktur Organisasi</a>
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

    <!-- Hero Slider -->
    <div class="hero-slider">
        <div class="slides" id="slider">
            @for ($i = 0; $i < 5; $i++)
            <div class="slide">
                <img src="{{ asset('images/hero.png') }}" alt="School Life {{ $i + 1 }}">
                <div class="slide-overlay">
                    <h2>SPMB TA 2026 / 2027</h2>
                    <p>Selamat datang di Pusat Keunggulan SMKS Ala Delphi. Bergabunglah bersama kami untuk masa depan yang lebih cerah.</p>
                    <a href="#" class="btn-primary">PELAJARI LEBIH JAUH</a>
                </div>
            </div>
            @endfor
        </div>
        <button class="slider-btn prev-btn" id="prev">❮</button>
        <button class="slider-btn next-btn" id="next">❯</button>
    </div>

    <!-- Quick Info Bar -->
    <div class="quick-info-bar">
        <div class="info-item">
            <div class="info-icon"><i class="fas fa-school"></i></div>
            <p>NO BULLY, NO SENIORITAS, PPDB TIDAK ADA TES FISIK</p>
        </div>
        <div class="info-item">
            <div class="info-icon"><i class="fas fa-globe"></i></div>
            <p>KURIKULUM INTERNATIONAL BACCALAUREATE</p>
        </div>
        <div class="info-item">
            <div class="info-icon"><i class="fas fa-graduation-cap"></i></div>
            <p>BEASISWA PENDIDIKAN 3 TAHUN</p>
        </div>
        <div class="info-item">
            <div class="info-icon"><i class="fas fa-users-cog"></i></div>
            <p>39 GURU TERSERTIFIKASI IB</p>
        </div>
    </div>

    <!-- Sambutan Kepala Sekolah -->
    <section style="padding: 80px 0; background: linear-gradient(180deg, #fff 0%, #fafafa 100%);">
        <div class="container">

            <!-- Section Header -->
            <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 60px;">
                <div style="width: 6px; height: 50px; background: #e30613; border-radius: 3px; flex-shrink: 0;"></div>
                <div>
                    <p style="margin: 0; font-size: 0.8rem; font-weight: 700; color: #e30613; text-transform: uppercase; letter-spacing: 3px;">SMKS Ala Delphi Tiga Binanga</p>
                    <h2 style="margin: 5px 0 0; font-size: 1.8rem; font-weight: 800; color: #1a1a1a;">Sambutan Kepala Sekolah</h2>
                </div>
            </div>

            <!-- Layout Konten -->
            <div style="display: grid; grid-template-columns: 260px 1fr; gap: 60px; align-items: start;">

                <!-- Kolom Kiri: Foto -->
                <div style="position: sticky; top: 100px; text-align: center;">
                    <!-- Foto Kotak Elegan -->
                    <div style="position: relative; border-radius: 20px; overflow: hidden; box-shadow: 0 20px 50px rgba(227,6,19,0.18), 0 8px 20px rgba(0,0,0,0.1); margin-bottom: 0;">
                        <img src="{{ asset('images/kepala_sekolah.png') }}" alt="Kepala Sekolah" style="width: 100%; height: 340px; object-fit: cover; object-position: top center; display: block;">
                        <!-- Overlay gradient di bawah foto -->
                        <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(transparent, rgba(26,26,26,0.92)); padding: 30px 20px 22px;">
                            <h4 style="margin: 0; font-size: 1rem; font-weight: 800; color: #fff; letter-spacing: 0.5px;">NAMA KEPALA SEKOLAH</h4>
                            <p style="margin: 5px 0 0; font-size: 0.75rem; color: #fffb00; font-weight: 700; text-transform: uppercase; letter-spacing: 2px;">Kepala Sekolah</p>
                        </div>
                    </div>
                    <!-- Aksen dekorasi di bawah -->
                    <div style="height: 5px; background: linear-gradient(90deg, #e30613, #ff6b6b); border-radius: 0 0 10px 10px;"></div>
                </div>

                <!-- Kolom Kanan: Teks Sambutan -->
                <div>
                    <!-- Paragraf Pembuka -->
                    <p style="font-size: 0.95rem; line-height: 1.8; color: #555; margin-bottom: 25px;">
                        Puji syukur kita panjatkan ke hadirat <strong style="color: #333;">Allah SWT</strong>, yang senantiasa melimpahkan rahmat dan hidayah-Nya kepada kita semua. Shalawat serta salam semoga tetap tercurah kepada junjungan kita Nabi Muhammad SAW, beserta keluarga, sahabat, dan seluruh umatnya hingga akhir zaman.
                    </p>

                    <!-- Kutipan Utama -->
                    <div style="background: #fdfdfd; border: 1px solid #f0f0f0; border-left: 4px solid #e30613; padding: 25px 30px; border-radius: 0 15px 15px 0; margin-bottom: 20px; position: relative;">
                        <p style="margin: 0; font-size: 1.05rem; font-style: italic; color: #444; line-height: 1.7; font-weight: 500;">
                            "Perkenankan saya, mewakili seluruh civitas akademika SMKS Ala Delphi Tiga Binanga, untuk menyampaikan sepatah dua patah kata..."
                        </p>
                    </div>

                    <!-- Tombol Baca Selengkapnya -->
                    <a href="#" style="display: inline-flex; align-items: center; gap: 10px; color: #b8860b; text-decoration: none; font-size: 0.8rem; font-weight: 800; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 40px; transition: 0.3s;" onmouseover="this.style.gap='15px'" onmouseout="this.style.gap='10px'">
                        Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                    </a>

                    <!-- Grid Kartu Bawah -->
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <!-- Kartu Visi & Misi -->
                        <a href="{{ route('about.visi-misi') }}" style="background: white; border: 1px solid #eee; border-radius: 15px; padding: 25px; text-decoration: none; transition: 0.3s; box-shadow: 0 5px 15px rgba(0,0,0,0.02); position: relative; display: block;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.05)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 15px rgba(0,0,0,0.02)'">
                            <div style="position: absolute; top: 20px; right: 20px; color: #ccc;"><i class="fas fa-external-link-alt" style="font-size: 0.8rem;"></i></div>
                            <h4 style="margin: 0 0 15px; font-size: 0.85rem; font-weight: 800; color: #1a1a1a; text-transform: uppercase; letter-spacing: 1px;">Visi & Misi</h4>
                            <p style="margin: 0; font-size: 0.85rem; color: #777; line-height: 1.6;">Terwujudnya generasi penerus bangsa yang terampil dan handal yang mampu menyelaraskan kemajuan IPTEK dan IMTAQ.</p>
                        </a>

                        <!-- Kartu Mars Sekolah -->
                        <a href="#" style="background: white; border: 1px solid #eee; border-radius: 15px; padding: 25px; text-decoration: none; transition: 0.3s; box-shadow: 0 5px 15px rgba(0,0,0,0.02); position: relative; display: block;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.05)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 5px 15px rgba(0,0,0,0.02)'">
                            <div style="position: absolute; top: 20px; right: 20px; color: #ccc;"><i class="fas fa-external-link-alt" style="font-size: 0.8rem;"></i></div>
                            <h4 style="margin: 0 0 15px; font-size: 0.85rem; font-weight: 800; color: #1a1a1a; text-transform: uppercase; letter-spacing: 1px;">Mars Sekolah</h4>
                            <p style="margin: 0; font-size: 0.85rem; color: #777; line-height: 1.6;">Lagu resmi kebanggaan SMKS Ala Delphi Tiga Binanga yang membangkitkan semangat juang para siswa.</p>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Statistik Sekolah -->
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-top: 60px;">
                <div style="text-align: center; padding: 28px 20px; border-radius: 16px; background: #fff; border-bottom: 4px solid #e30613; box-shadow: 0 5px 20px rgba(0,0,0,0.05); transition: 0.3s;" onmouseover="this.style.transform='translateY(-6px)'" onmouseout="this.style.transform='translateY(0)'">
                    <h2 style="font-size: 2.5rem; font-weight: 800; margin: 0; color: #1a1a1a;">54+</h2>
                    <p style="text-transform: uppercase; font-weight: 800; color: #e30613; margin: 8px 0 0; letter-spacing: 2px; font-size: 0.72rem;">Tenaga Pendidik</p>
                </div>
                <div style="text-align: center; padding: 28px 20px; border-radius: 16px; background: #e30613; border-bottom: 4px solid #a00; box-shadow: 0 5px 20px rgba(227,6,19,0.2); transition: 0.3s;" onmouseover="this.style.transform='translateY(-6px)'" onmouseout="this.style.transform='translateY(0)'">
                    <h2 style="font-size: 2.5rem; font-weight: 800; margin: 0; color: white;">1,200+</h2>
                    <p style="text-transform: uppercase; font-weight: 800; color: #fffb00; margin: 8px 0 0; letter-spacing: 2px; font-size: 0.72rem;">Siswa Aktif</p>
                </div>
                <div style="text-align: center; padding: 28px 20px; border-radius: 16px; background: #fff; border-bottom: 4px solid #e30613; box-shadow: 0 5px 20px rgba(0,0,0,0.05); transition: 0.3s;" onmouseover="this.style.transform='translateY(-6px)'" onmouseout="this.style.transform='translateY(0)'">
                    <h2 style="font-size: 2.5rem; font-weight: 800; margin: 0; color: #1a1a1a;">32</h2>
                    <p style="text-transform: uppercase; font-weight: 800; color: #e30613; margin: 8px 0 0; letter-spacing: 2px; font-size: 0.72rem;">Fasilitas Sekolah</p>
                </div>
            </div>

        </div>
    </section>

    <!-- News Section -->
    <section class="news-section">
        <div class="container">
            <div class="section-title">
                <h2>Artikel dan Berita Terbaru</h2>
            </div>
            <div class="news-tabs">
                <button class="tab-btn active" onclick="loadPosts('berita', this)">Berita</button>
                <button class="tab-btn" onclick="loadPosts('prestasi', this)">Prestasi</button>
                <button class="tab-btn" onclick="loadPosts('press_release', this)">Press Release</button>
            </div>
            <div class="news-grid" id="news-container">
                <!-- Data akan dimuat via JavaScript -->
                <div style="grid-column: 1/-1; text-align: center; padding: 50px;">
                    <i class="fas fa-spinner fa-spin" style="font-size: 2rem; color: #e30613;"></i>
                </div>
            </div>
            <div style="text-align: center; margin-top: 40px;">
                <button class="btn-primary" style="padding: 10px 30px;">Lihat Semua</button>
            </div>
        </div>
    </section>

    <!-- Post Loading Script -->
    <script>
        async function loadPosts(category, element) {
            // Update UI Tabs
            if(element) {
                document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
                element.classList.add('active');
            }

            const container = document.getElementById('news-container');
            container.innerHTML = '<div style="grid-column: 1/-1; text-align: center; padding: 50px;"><i class="fas fa-spinner fa-spin" style="font-size: 2rem; color: #e30613;"></i></div>';

            try {
                const response = await fetch(`/api/posts?category=${category}`);
                const posts = await response.json();

                if (posts.length === 0) {
                    container.innerHTML = '<div style="grid-column: 1/-1; text-align: center; padding: 50px; color: #888;">Belum ada artikel di kategori ini.</div>';
                    return;
                }

                container.innerHTML = '';
                posts.forEach(post => {
                    const date = new Date(post.published_at).toLocaleDateString('id-ID', {
                        day: 'numeric',
                        month: 'long',
                        year: 'numeric'
                    });
                    
                    const image = post.image ? `/storage/${post.image}` : '/images/news_1.png';

                    container.innerHTML += `
                        <div class="news-card">
                            <div class="news-img">
                                <img src="${image}" alt="${post.title}">
                            </div>
                            <div class="news-body">
                                <h3>${post.title}</h3>
                                <span>${date}</span>
                                <a href="/berita/${post.id}" class="read-more-link" style="display: block; margin-top: 15px; color: #e30613; text-decoration: none; font-weight: 700; font-size: 0.9rem;">BACA SELENGKAPNYA <i class="fas fa-arrow-right" style="font-size: 0.8rem;"></i></a>
                            </div>
                        </div>
                    `;
                });
            } catch (error) {
                console.error('Error loading posts:', error);
                container.innerHTML = '<div style="grid-column: 1/-1; text-align: center; padding: 50px; color: #e30613;">Gagal memuat data.</div>';
            }
        }

        // Initial load
        document.addEventListener('DOMContentLoaded', () => {
            loadPosts('berita');
        });
    </script>
        </div>
    </section>

    <!-- Feature Grid Section -->
    <section class="feature-grid-section">
        <div class="feature-container">
            <div class="feature-item tall" style="background-image: url('{{ asset('images/hero.png') }}');">
                <div class="feature-overlay">
                    <h3>REKOR MURI SBMPTN 2026</h3>
                </div>
            </div>
            <div class="feature-item dark">
                <div class="feature-content">
                    <h3>Sekolah Kejuruan Terbaik di Indonesia</h3>
                </div>
            </div>
            <div class="feature-item wide" style="background-image: url('{{ asset('images/hero.png') }}');">
                <div class="feature-overlay">
                    <h3>Kurikulum International Baccalaureate IB WORLD SCHOOL</h3>
                </div>
            </div>
            <div class="feature-item small" style="background-image: url('{{ asset('images/hero.png') }}');">
                <div class="feature-overlay">
                    <h3>FSS, BILLIARD, LAP. OLAHRAGA</h3>
                </div>
            </div>
            <div class="feature-item medium" style="background-image: url('{{ asset('images/hero.png') }}');">
                <div class="feature-overlay">
                    <h3>LABORATORIUM BAHASA - KOMPUTER - SCIENCE</h3>
                </div>
            </div>
            <div class="feature-item small" style="background-image: url('{{ asset('images/hero.png') }}');">
                <div class="feature-overlay">
                    <h3>PERPUSTAKAAN</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="faq-header">
            <h2>FAQ SPMB</h2>
            <p>Temukan jawaban untuk pertanyaan umum seputar Penerimaan Siswa Baru</p>
            <i class="fas fa-chevron-down"></i>
        </div>
        <div class="container">
            <div class="faq-accordion">
                <details>
                    <summary>KAPAN SPMB ONLINE AKAN DILAKSANAKAN?</summary>
                    <div class="faq-content">
                        <p>Pendaftaran Siswa Baru (SPMB) Online SMK Ala Delphi akan dibuka mulai Januari 2026 hingga Juli 2026.</p>
                    </div>
                </details>
                <details>
                    <summary>APA SAJA TAHAPAN SELEKSI MASUK SMK ALA DELPHI?</summary>
                    <div class="faq-content">
                        <p>Seleksi terdiri dari 3 tahap utama:</p>
                        <ul>
                            <li>Seleksi Administrasi (Online)</li>
                            <li>Tes Akademik & Wawancara</li>
                            <li>Tes Kesehatan & Fisik</li>
                        </ul>
                    </div>
                </details>
                <details>
                    <summary>JALUR APA SAJA UNTUK BISA DITERIMA?</summary>
                    <div class="faq-content">
                        <p>Kami menyediakan jalur Prestasi (Akademik/Non-Akademik), Jalur Reguler, dan Jalur Beasiswa Kurang Mampu.</p>
                    </div>
                </details>
                <details>
                    <summary>MATA PELAJARAN APA SAJA YANG DIUJIKAN?</summary>
                    <div class="faq-content">
                        <p>Mata pelajaran yang diujikan meliputi Matematika, Bahasa Indonesia, Bahasa Inggris, dan Pengetahuan Dasar Kejuruan.</p>
                    </div>
                </details>
            </div>

            <div style="text-align: center; margin-top: 50px;">
                <a href="{{ route('daftar') }}" class="btn-primary" style="padding: 15px 50px; font-size: 1.2rem; background: #c5a059;">DAFTAR SEGERA ❯</a>
            </div>
        </div>
    </section>


    <!-- Footer -->
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
                        <li><a href="#" style="color: white; text-decoration: none; transition: 0.3s;"><i class="fas fa-chevron-right" style="font-size: 0.7rem; margin-right: 8px;"></i> Kurikulum</a></li>
                        <li><a href="#" style="color: white; text-decoration: none; transition: 0.3s;"><i class="fas fa-chevron-right" style="font-size: 0.7rem; margin-right: 8px;"></i> Ekstrakurikuler</a></li>
                        <li><a href="#" style="color: white; text-decoration: none; transition: 0.3s;"><i class="fas fa-chevron-right" style="font-size: 0.7rem; margin-right: 8px;"></i> Galeri</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div style="border-top: 1px solid rgba(255,255,255,0.1); margin-top: 60px; padding-top: 30px; text-align: center;">
            <p style="color: rgba(255,255,255,0.7); font-size: 0.85rem;">&copy; 2026 SMK SWASTA ALA DELPHI - TIGA BINANGA. All rights reserved.</p>
        </div>
    </footer>

    <!-- Slider Script -->
    <script>
        const slider = document.getElementById('slider');
        const next = document.getElementById('next');
        const prev = document.getElementById('prev');
        const slides = document.querySelectorAll('.slide');
        let index = 0;

        function showSlide(n) {
            slides[index].classList.remove('active');
            if (n >= 5) index = 0;
            else if (n < 0) index = 4;
            else index = n;
            
            slider.style.transform = `translateX(${-index * 20}%)`;
            slides[index].classList.add('active');
        }

        // Initialize first slide
        slides[0].classList.add('active');

        next.addEventListener('click', () => showSlide(index + 1));
        prev.addEventListener('click', () => showSlide(index - 1));

        // Auto slide
        setInterval(() => showSlide(index + 1), 6000);
    </script>

</body>
</html>
