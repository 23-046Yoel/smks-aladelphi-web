<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $post->title }} | SMK Ala Delphi</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;600;800&family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .article-header {
            padding: 80px 0 40px;
            background: #f8f9fa;
            text-align: center;
        }
        .article-category {
            text-transform: uppercase;
            color: #e30613;
            font-weight: 800;
            letter-spacing: 2px;
            display: block;
            margin-bottom: 15px;
        }
        .article-title {
            font-size: 3rem;
            max-width: 900px;
            margin: 0 auto 20px;
            line-height: 1.2;
        }
        .article-meta {
            color: #888;
        }
        .article-content {
            max-width: 800px;
            margin: 50px auto;
            padding: 0 20px;
            line-height: 1.8;
            font-size: 1.1rem;
            color: #333;
        }
        .article-image {
            width: 100%;
            max-width: 900px;
            height: 500px;
            object-fit: cover;
            border-radius: 30px;
            margin: -100px auto 0;
            display: block;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .back-btn {
            display: inline-block;
            margin-top: 40px;
            color: #333;
            text-decoration: none;
            font-weight: 600;
        }
        .back-btn:hover { color: #e30613; }
    </style>
</head>
<body>
    <header style="position: relative; background: #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
        <div class="logo">
            <img src="{{ asset('images/official_logo.png') }}" alt="Logo" style="height: 60px;">
            <div class="logo-text">
                <h1 style="font-size: 1.2rem;">SMKS ALA DELPHI</h1>
            </div>
        </div>
        <nav>
            <ul>
                <li><a href="{{ url('/') }}">Beranda</a></li>
                <li><a href="{{ url('/') }}#news">Berita</a></li>
            </ul>
        </nav>
    </header>

    <section class="article-header">
        <div class="container">
            <span class="article-category">{{ str_replace('_', ' ', $post->category) }}</span>
            <h1 class="article-title">{{ $post->title }}</h1>
            <div class="article-meta">
                <span><i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($post->published_at)->format('d F Y') }}</span>
                <span style="margin-left: 20px;"><i class="far fa-user"></i> Admin Sekolah</span>
            </div>
        </div>
    </section>

    @if($post->image)
        <img src="{{ asset('storage/' . $post->image) }}" class="article-image" alt="{{ $post->title }}">
    @else
        <div class="article-image" style="background: #eee; display: flex; align-items: center; justify-content: center;">
            <i class="fas fa-image fa-4x" style="color: #ccc;"></i>
        </div>
    @endif

    <article class="article-content">
        {!! nl2br(e($post->content)) !!}
        
        <div style="border-top: 1px solid #eee; margin-top: 50px;">
            <a href="{{ url('/') }}" class="back-btn"><i class="fas fa-arrow-left"></i> Kembali ke Beranda</a>
        </div>
    </article>

    <footer style="margin-top: 100px;">
        <div class="footer-bottom">
            <p>&copy; 2026 SMK Ala Delphi - Tiga Binanga.</p>
        </div>
    </footer>
</body>
</html>
