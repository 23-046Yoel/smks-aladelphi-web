<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen SPP | Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --red: #e30613;
            --dark: #1a1a1a;
            --light: #f8f9fa;
            --green: #28a745;
        }
        body {
            font-family: 'Outfit', sans-serif;
            margin: 0;
            display: flex;
            background: var(--light);
        }
        .sidebar {
            width: 260px;
            height: 100vh;
            background: var(--dark);
            color: white;
            padding: 30px 20px;
            position: fixed;
            overflow-y: auto;
        }
        .sidebar-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 50px;
        }
        .sidebar-header img {
            height: 40px;
        }
        .sidebar nav ul {
            list-style: none;
            padding: 0;
        }
        .sidebar nav ul li {
            margin-bottom: 8px;
        }
        .sidebar nav ul li a {
            color: #bbb;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            border-radius: 12px;
            transition: 0.3s;
        }
        .sidebar nav ul li a:hover, .sidebar nav ul li a.active {
            background: rgba(227, 6, 19, 0.1);
            color: var(--red);
            font-weight: 600;
        }
        .main {
            margin-left: 260px;
            padding: 40px;
            width: 100%;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }
        .panel {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.02);
            margin-bottom: 30px;
        }
        .search-box {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
        }
        .search-box input {
            flex: 1;
            padding: 15px 20px;
            border: 2px solid #eee;
            border-radius: 12px;
            font-family: 'Outfit', sans-serif;
            font-size: 1rem;
        }
        .btn {
            padding: 15px 25px;
            border-radius: 12px;
            border: none;
            background: var(--red);
            color: white;
            font-family: 'Outfit', sans-serif;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn:hover { background: #c00; }
        
        .student-profile {
            display: flex;
            align-items: center;
            gap: 20px;
            padding-bottom: 20px;
            border-bottom: 2px solid #f0f0f0;
            margin-bottom: 20px;
        }
        .avatar {
            width: 60px; height: 60px;
            background: #f0f0f0;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.5rem; color: #888;
        }
        
        .months-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
        }
        .month-card {
            border: 2px solid #eee;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            position: relative;
        }
        .month-card.paid {
            border-color: var(--green);
            background: rgba(40,167,69,0.05);
        }
        .month-card h4 { margin: 0 0 10px; font-size: 1.1rem; }
        
        .badge {
            padding: 5px 12px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 800;
            display: inline-block;
            margin-bottom: 10px;
        }
        .badge-paid { background: var(--green); color: white; }
        .badge-unpaid { background: #ffe6e6; color: var(--red); }
        
        .action-btn {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: none;
            background: var(--dark);
            color: white;
            font-weight: 600;
            cursor: pointer;
            font-family: 'Outfit';
        }
        .action-btn:hover { background: #333; }
        .btn-print {
            background: #f0f0f0;
            color: #333;
        }
        .btn-print:hover { background: #e0e0e0; }

        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }
        .modal {
            background: white;
            border-radius: 20px;
            width: 100%;
            max-width: 500px;
            padding: 30px;
            box-shadow: 0 15px 50px rgba(0,0,0,0.1);
        }
        .form-group { margin-bottom: 20px; text-align: left; }
        .form-group label { display: block; margin-bottom: 8px; color: #555; font-weight: 600; }
        .form-group input { 
            width: 100%; padding: 12px 15px; 
            border: 2px solid #eee; border-radius: 10px; 
            font-family: 'Outfit'; font-size: 1rem; box-sizing: border-box;
        }
        .form-actions { display: flex; gap: 10px; justify-content: flex-end; margin-top: 30px; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <img src="{{ asset('images/official_logo.png') }}" alt="Logo">
            <h3>ADMIN PANEL</h3>
        </div>
        <nav>
            <ul>
                <li><a href="{{ route('admin.dashboard') }}"><i class="fas fa-th-large"></i> Dashboard</a></li>
                <li><a href="{{ route('admin.posts.index') }}"><i class="fas fa-bullhorn"></i> Kelola Konten</a></li>
                <li><a href="{{ route('admin.registrations.index') }}"><i class="fas fa-user-plus"></i> Pendaftar SPMB</a></li>
                <li><a href="#"><i class="fas fa-users"></i> Data Siswa</a></li>
                <li><a href="{{ route('admin.employees.index') }}"><i class="fas fa-chalkboard-teacher"></i> Kepegawaian & HR</a></li>
                <li><a href="{{ route('admin.finance.index') }}"><i class="fas fa-wallet"></i> Kas Keuangan</a></li>
                <li><a href="{{ route('admin.spp.index') }}" class="active"><i class="fas fa-file-invoice-dollar"></i> Manajemen SPP</a></li>
                <li><a href="{{ route('admin.inventory.index') }}"><i class="fas fa-boxes"></i> Inventaris & Gudang</a></li>
                <li><a href="#"><i class="fas fa-cog"></i> Pengaturan</a></li>
                <li style="margin-top: 50px;"><a href="{{ url('/') }}"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
        </nav>
    </div>
    <div class="main">
        <div class="header">
            <div>
                <h1 style="margin: 0;">Manajemen SPP Siswa</h1>
                <p style="color: #888; margin: 5px 0 0;">Catat pembayaran SPP dan cetak bukti pembayaran</p>
            </div>
        </div>

        <div class="panel">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h3 style="margin: 0;">Cari Siswa Berdasarkan NIS</h3>
                <button class="btn" style="background: var(--dark);" onclick="openModal()"><i class="fas fa-user-plus"></i> Tambah Data Siswa</button>
            </div>
            
            <form action="{{ route('admin.spp.index') }}" method="GET" class="search-box">
                <input type="text" name="nis" placeholder="Masukkan Nomor Induk Siswa (NIS)..." value="{{ request('nis') }}" required>
                <button type="submit" class="btn"><i class="fas fa-search"></i> Cari Data</button>
            </form>

            @if(request()->has('nis') && !$selectedStudent)
                <div style="color: var(--red); background: #ffe6e6; padding: 15px; border-radius: 10px;">
                    Siswa dengan NIS "{{ request('nis') }}" tidak ditemukan. Silakan tambahkan data siswa terlebih dahulu.
                </div>
            @endif
        </div>

        @if($selectedStudent)
        <div class="panel">
            <div class="student-profile">
                <div class="avatar"><i class="fas fa-user"></i></div>
                <div>
                    <h2 style="margin:0;">{{ $selectedStudent->name }}</h2>
                    <p style="margin:5px 0 0; color:#888;">NIS: {{ $selectedStudent->nis }} | Kelas: {{ $selectedStudent->class }} | Jurusan: {{ $selectedStudent->major }} | Tagihan: Rp {{ number_format($selectedStudent->spp_amount, 0, ',', '.') }}/bulan</p>
                </div>
            </div>

            <h3 style="margin-bottom: 20px;">Kartu SPP Tahun {{ date('Y') }}</h3>
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
                    @endphp
                    <div class="month-card {{ $isPaid ? 'paid' : '' }}">
                        <h4>{{ $name }}</h4>
                        @if($isPaid)
                            <span class="badge badge-paid"><i class="fas fa-check"></i> LUNAS</span>
                            <p style="font-size:0.8rem; color:#777; margin:0 0 10px;">{{ \Carbon\Carbon::parse($payments[$num]->payment_date)->format('d/m/Y') }}</p>
                            <button class="action-btn btn-print"><i class="fas fa-print"></i> Cetak Struk</button>
                        @else
                            <span class="badge badge-unpaid"><i class="fas fa-times"></i> BELUM BAYAR</span>
                            <p style="font-size:0.8rem; color:transparent; margin:0 0 10px;">-</p>
                            <form action="{{ route('admin.spp.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="student_id" value="{{ $selectedStudent->id }}">
                                <input type="hidden" name="month" value="{{ $num }}">
                                <input type="hidden" name="year" value="{{ date('Y') }}">
                                <input type="hidden" name="amount" value="{{ $selectedStudent->spp_amount }}">
                                <button type="submit" class="action-btn" onclick="return confirm('Proses pembayaran SPP bulan {{ $name }} sejumlah Rp {{ number_format($selectedStudent->spp_amount, 0, ',', '.') }}?')"><i class="fas fa-cash-register"></i> Bayar Sekarang</button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <!-- Modal Form Tambah Siswa -->
    <div class="modal-overlay" id="studentModal">
        <div class="modal">
            <h2 style="margin-top:0;">Tambah Data Siswa Baru</h2>
            <form action="{{ route('admin.spp.student.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nomor Induk Siswa (NIS)</label>
                    <input type="text" name="nis" placeholder="Contoh: 102938" required>
                </div>
                <div class="form-group">
                    <label>Nama Lengkap Siswa</label>
                    <input type="text" name="name" placeholder="Nama Lengkap" required>
                </div>
                <div style="display:grid; grid-template-columns: 1fr 1fr; gap:15px;">
                    <div class="form-group">
                        <label>Kelas</label>
                        <input type="text" name="class" placeholder="Contoh: X" required>
                    </div>
                    <div class="form-group">
                        <label>Jurusan</label>
                        <input type="text" name="major" placeholder="Contoh: RPL" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Tagihan SPP per Bulan (Rp)</label>
                    <input type="number" name="spp_amount" value="150000" min="0" required>
                </div>
                
                <div class="form-actions">
                    <button type="button" class="btn" style="background:#eee; color:#333;" onclick="closeModal()">Batal</button>
                    <button type="submit" class="btn" style="background:var(--dark);"><i class="fas fa-save"></i> Simpan Siswa</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('studentModal').style.display = 'flex';
        }
        function closeModal() {
            document.getElementById('studentModal').style.display = 'none';
        }
    </script>
</body>
</html>
