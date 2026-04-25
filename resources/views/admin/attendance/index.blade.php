@extends('admin.dashboard')

@section('content')
<div class="header">
    <div>
        <h2 style="margin:0; font-size: 1.8rem; font-weight: 800;">Sistem Absensi Kehadiran</h2>
        <p style="margin: 5px 0 0; color: #888;">Generate QR Code per Mata Pelajaran</p>
    </div>
</div>

<div class="content-grid" style="grid-template-columns: 1fr;">
    <div class="panel">
        <h3>Daftar Mata Pelajaran (Generate QR Code)</h3>
        <table>
            <thead>
                <tr>
                    <th>KODE</th>
                    <th>Mata Pelajaran</th>
                    <th>Guru / Instruktur</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subjects as $subject)
                <tr>
                    <td><strong>{{ $subject->code }}</strong></td>
                    <td>{{ $subject->name }}</td>
                    <td>{{ $subject->teacher_name }}</td>
                    <td>
                        <a href="{{ route('admin.attendance.qr', $subject->id) }}" class="btn-primary" style="padding: 8px 15px; font-size: 0.8rem; border-radius: 8px; text-decoration: none;">
                            <i class="fas fa-qrcode"></i> Buka QR Kelas
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="panel" style="margin-top: 30px;">
        <h3>Data Absensi Terbaru (Hari Ini)</h3>
        <table>
            <thead>
                <tr>
                    <th>Waktu Scan</th>
                    <th>Nama Siswa</th>
                    <th>NIS</th>
                    <th>Mata Pelajaran</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentAttendances as $attendance)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($attendance->scanned_at)->format('H:i:s') }} WIB</td>
                    <td><strong>{{ $attendance->student->name }}</strong></td>
                    <td>{{ $attendance->student->nis }}</td>
                    <td>{{ $attendance->subject->name }}</td>
                    <td><span class="badge badge-success">Hadir</span></td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: #888;">Belum ada absensi hari ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
    .btn-primary {
        background: linear-gradient(135deg, #e30613, #b0050f);
        color: white;
        border: none;
        cursor: pointer;
        transition: 0.3s;
    }
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(227, 6, 19, 0.3);
    }
</style>
@endsection
