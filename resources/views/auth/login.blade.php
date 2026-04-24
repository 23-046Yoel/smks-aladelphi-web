<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | SMK Ala Delphi</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --red: #e30613;
            --dark: #1a1a1a;
            --white: #ffffff;
        }
        body {
            font-family: 'Outfit', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        .login-card {
            background: white;
            padding: 50px;
            border-radius: 30px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 450px;
            text-align: center;
        }
        .login-card img {
            height: 100px;
            margin-bottom: 20px;
        }
        .login-card h2 {
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 30px;
        }
        .form-group {
            text-align: left;
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: #555;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #eee;
            border-radius: 12px;
            font-family: inherit;
            box-sizing: border-box;
            transition: 0.3s;
        }
        .form-group input:focus {
            border-color: var(--red);
            outline: none;
        }
        .btn-login {
            width: 100%;
            padding: 15px;
            background: var(--red);
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 800;
            cursor: pointer;
            font-size: 1rem;
            transition: 0.3s;
            margin-top: 10px;
        }
        .btn-login:hover {
            background: #b0050f;
            transform: translateY(-2px);
        }
        .back-home {
            display: block;
            margin-top: 20px;
            color: #888;
            text-decoration: none;
            font-size: 0.9rem;
        }
        .back-home:hover {
            color: var(--red);
        }
    </style>
</head>
<body>
    <div class="login-card">
        <img src="{{ asset('images/official_logo.png') }}" alt="Logo">
        <h2>LOGIN SISTEM</h2>
        <form action="{{ url('/login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Pilih Akses</label>
                <select name="role">
                    <option value="admin">Administrator / Operator</option>
                    <option value="guru">Guru / Tenaga Pendidik</option>
                    <option value="staff">Staff Administrasi</option>
                </select>
            </div>
            <div class="form-group">
                <label>Username / Email</label>
                <input type="text" placeholder="Masukkan username">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" placeholder="••••••••">
            </div>
            <button type="submit" class="btn-login">MASUK KE SISTEM</button>
        </form>
        <a href="{{ url('/') }}" class="back-home"> Kembali ke Beranda</a>
    </div>
</body>
</html>
