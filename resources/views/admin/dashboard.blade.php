@extends('layouts.admin')

@section('title', 'Dashboard')

@section('extra_css')
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 25px;
        margin-bottom: 40px;
    }
    .stat-card {
        background: white;
        padding: 40px 20px;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.05);
        text-align: center;
        border-bottom: 4px solid var(--red);
        transition: 0.3s;
    }
    .stat-card.red-version {
        background: var(--red);
        color: white;
        border-bottom: none;
        box-shadow: 0 15px 45px rgba(227, 6, 19, 0.2);
    }
    .stat-card h2 {
        font-size: 3rem;
        margin: 0;
        font-weight: 800;
    }
    .stat-card h5 {
        margin: 15px 0 0;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-size: 0.75rem;
        color: var(--red);
    }
    .stat-card.red-version h5 {
        color: rgba(255,255,255,0.8);
    }

    .content-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 25px;
    }
    .panel {
        background: white;
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
        overflow-x: auto;
    }
    .panel h3 {
        margin-top: 0;
        border-bottom: 2px solid #f0f0f0;
        padding-bottom: 15px;
        margin-bottom: 20px;
        font-size: 1.1rem;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        min-width: 500px;
    }
    th {
        text-align: left;
        color: #888;
        padding-bottom: 15px;
        font-size: 0.8rem;
    }
    td {
        padding: 15px 0;
        border-top: 1px solid #f8f8f8;
        font-size: 0.9rem;
    }
    .badge {
        padding: 5px 12px;
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: 600;
    }
    .badge-success { background: #e6f7ed; color: #28a745; }

    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
        .content-grid {
            grid-template-columns: 1fr;
        }
        .stat-card h2 {
            font-size: 2.5rem;
        }
        .quick-actions {
            flex-direction: column;
        }
        .btn-action {
            width: 100%;
            justify-content: center;
        }
    }
@endsection

@section('content')
    <div class="quick-actions" style="display: flex; gap: 15px; margin-bottom: 30px; flex-wrap: wrap;">
        <a href="{{ route('admin.finance.index') }}" class="btn-action" style="background: var(--dark); color: white;"><i class="fas fa-wallet"></i> Buka Buku Kas</a>
        <a href="{{ route('admin.spp.index') }}" class="btn-action" style="background: var(--red); color: white;"><i class="fas fa-file-invoice-dollar"></i> Kelola Pembayaran SPP</a>
        <a href="{{ route('admin.registrations.index') }}" class="btn-action" style="background: white; color: var(--dark); border: 2px solid #eee;"><i class="fas fa-user-plus"></i> Cek Pendaftar Baru</a>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <h2>{{ $totalEmployeeCount > 0 ? $totalEmployeeCount : '54' }}+</h2>
            <h5>Tenaga Pendidik & Staf</h5>
        </div>
        <div class="stat-card red-version">
            <h2>{{ $studentCount > 0 ? number_format($studentCount) : '1,200' }}+</h2>
            <h5>Siswa Aktif</h5>
        </div>
        <div class="stat-card">
            <h2>{{ $facilityCount > 0 ? $facilityCount : '32' }}</h2>
            <h5>Fasilitas Sekolah</h5>
        </div>
    </div>

    <div class="content-grid">
        <div class="panel">
            <h3>Tenaga Pendidik & Kependidikan Terbaru</h3>
            <table>
                <thead>
                    <tr>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $emp)
                    <tr>
                        <td>{{ $emp->nip ?? '-' }}</td>
                        <td style="font-weight: 600;">{{ $emp->name }}</td>
                        <td>{{ $emp->position }}</td>
                        <td><span class="badge badge-success">{{ strtoupper($emp->status) }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="panel">
            <h3>Agenda Sekolah</h3>
            <div style="display: flex; flex-direction: column; gap: 15px;">
                <div style="padding-left: 15px; border-left: 3px solid var(--red);">
                    <p style="margin: 0; font-weight: 600;">Ujian Akhir Semester</p>
                    <small style="color: #888;">10 Mei 2026</small>
                </div>
                <div style="padding-left: 15px; border-left: 3px solid var(--dark);">
                    <p style="margin: 0; font-weight: 600;">Rapat Guru & Staff</p>
                    <small style="color: #888;">15 Mei 2026</small>
                </div>
                <div style="padding-left: 15px; border-left: 3px solid var(--red);">
                    <p style="margin: 0; font-weight: 600;">Wisuda Angkatan 2026</p>
                    <small style="color: #888;">20 Juni 2026</small>
                </div>
            </div>
        </div>
    </div>
@endsection
