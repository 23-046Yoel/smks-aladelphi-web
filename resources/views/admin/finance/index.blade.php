<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keuangan | Admin Dashboard</title>
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
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            margin-bottom: 40px;
        }
        .stat-card {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.02);
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .stat-icon {
            width: 60px;
            height: 60px;
            background: rgba(227, 6, 19, 0.05);
            color: var(--red);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 15px;
            font-size: 1.5rem;
        }
        .stat-icon.green {
            background: rgba(40, 167, 69, 0.1);
            color: var(--green);
        }
        .stat-icon.blue {
            background: rgba(0, 123, 255, 0.1);
            color: #007bff;
        }
        .stat-data h4 {
            margin: 0;
            color: #888;
            font-size: 0.85rem;
        }
        .stat-data p {
            margin: 5px 0 0;
            font-size: 1.5rem;
            font-weight: 800;
        }
        .panel {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.02);
            margin-bottom: 30px;
        }
        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .panel-header h3 {
            margin: 0;
        }
        .btn {
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            cursor: pointer;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: white;
        }
        .btn-green { background: var(--green); }
        .btn-red { background: var(--red); }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th {
            text-align: left;
            color: #888;
            padding-bottom: 15px;
        }
        td {
            padding: 15px 0;
            border-top: 1px solid #f8f8f8;
        }
        .badge {
            padding: 5px 12px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        .badge-income { background: rgba(40, 167, 69, 0.1); color: var(--green); }
        .badge-expense { background: rgba(227, 6, 19, 0.1); color: var(--red); }
        .text-right { text-align: right; }
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
                <li><a href="{{ route('admin.finance.index') }}" class="active"><i class="fas fa-wallet"></i> Keuangan</a></li>
                <li><a href="{{ route('admin.inventory.index') }}"><i class="fas fa-boxes"></i> Inventaris & Gudang</a></li>
                <li><a href="#"><i class="fas fa-cog"></i> Pengaturan</a></li>
                <li style="margin-top: 50px;"><a href="{{ url('/') }}"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
        </nav>
    </div>
    <div class="main">
        <div class="header">
            <div>
                <h1 style="margin: 0;">Sistem Keuangan & Buku Kas</h1>
                <p style="color: #888; margin: 5px 0 0;">Manajemen Pemasukan, Pengeluaran, dan SPP</p>
            </div>
            <div style="background: white; padding: 10px 20px; border-radius: 50px; box-shadow: 0 5px 15px rgba(0,0,0,0.02);">
                <i class="far fa-calendar-alt"></i> {{ date('d F Y') }}
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon blue"><i class="fas fa-piggy-bank"></i></div>
                <div class="stat-data">
                    <h4>Total Saldo Kas</h4>
                    <p>Rp {{ number_format($balance, 0, ',', '.') }}</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon green"><i class="fas fa-arrow-down"></i></div>
                <div class="stat-data">
                    <h4>Pemasukan (Income)</h4>
                    <p>Rp {{ number_format($totalIncome, 0, ',', '.') }}</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-arrow-up"></i></div>
                <div class="stat-data">
                    <h4>Pengeluaran (Expense)</h4>
                    <p>Rp {{ number_format($totalExpense, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <div class="panel">
            <div class="panel-header">
                <h3>Buku Kas Umum</h3>
                <div style="display: flex; gap: 10px;">
                    <button class="btn btn-green"><i class="fas fa-plus"></i> Pemasukan</button>
                    <button class="btn btn-red"><i class="fas fa-minus"></i> Pengeluaran</button>
                </div>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Jenis</th>
                        <th class="text-right">Nominal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $trx)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($trx->transaction_date)->format('d M Y') }}</td>
                        <td>{{ $trx->description }}</td>
                        <td>
                            @if($trx->type == 'income')
                                <span class="badge badge-income">Pemasukan</span>
                            @else
                                <span class="badge badge-expense">Pengeluaran</span>
                            @endif
                        </td>
                        <td class="text-right">
                            <strong style="color: {{ $trx->type == 'income' ? 'var(--green)' : 'var(--red)' }}">
                                {{ $trx->type == 'income' ? '+' : '-' }} Rp {{ number_format($trx->amount, 0, ',', '.') }}
                            </strong>
                        </td>
                        <td>
                            <button style="border:none; background:none; color:#888; cursor:pointer;"><i class="fas fa-edit"></i></button>
                            <button style="border:none; background:none; color:var(--red); cursor:pointer;"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align: center; color: #888;">Belum ada data transaksi keuangan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
