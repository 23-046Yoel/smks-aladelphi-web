<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Absensi - {{ $subject->name }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --red: #e30613; --dark: #1a1a1a; --light: #f4f6f9; }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Outfit', sans-serif; background: var(--light); min-height: 100vh; }

        /* Topbar */
        .topbar { background: var(--dark); color: white; padding: 14px 35px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 100; box-shadow: 0 2px 20px rgba(0,0,0,0.3); }
        .topbar-left { display: flex; align-items: center; gap: 14px; }
        .topbar-left img { height: 36px; }
        .topbar-left .divider { width: 1px; height: 24px; background: rgba(255,255,255,0.2); }
        .breadcrumb { font-size: 0.82rem; color: #aaa; }
        .breadcrumb a { color: #aaa; text-decoration: none; transition: 0.2s; }
        .breadcrumb a:hover { color: white; }
        .breadcrumb span { color: white; font-weight: 600; }
        .btn-back { display: inline-flex; align-items: center; gap: 8px; background: rgba(255,255,255,0.1); color: white; padding: 9px 18px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 0.83rem; transition: 0.2s; }
        .btn-back:hover { background: rgba(227,6,19,0.3); }

        /* Content */
        .container { max-width: 1200px; margin: 0 auto; padding: 30px 25px; }

        /* Subject header */
        .subject-header { background: white; border-radius: 18px; padding: 28px 32px; margin-bottom: 25px; box-shadow: 0 2px 12px rgba(0,0,0,0.05); display: flex; align-items: center; gap: 24px; border-left: 5px solid var(--red); }
        .subject-icon { width: 60px; height: 60px; background: rgba(227,6,19,0.08); border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: var(--red); flex-shrink: 0; }
        .subject-info h1 { font-size: 1.4rem; font-weight: 800; color: var(--dark); margin-bottom: 8px; }
        .subject-meta { display: flex; gap: 20px; flex-wrap: wrap; }
        .meta-item { display: flex; align-items: center; gap: 7px; font-size: 0.82rem; color: #666; }
        .meta-item i { color: var(--red); width: 14px; text-align: center; }
        .meta-item strong { color: var(--dark); }
        .president-tag { display: inline-flex; align-items: center; gap: 6px; background: #fef3c7; color: #92400e; padding: 3px 12px; border-radius: 50px; font-size: 0.78rem; font-weight: 700; border: 1px solid #fde68a; }

        /* Alert */
        .alert { padding: 13px 18px; border-radius: 12px; margin-bottom: 20px; font-size: 0.87rem; font-weight: 600; display: flex; align-items: center; gap: 10px; }
        .alert-success { background: #ecfdf5; color: #065f46; border-left: 4px solid #10b981; }

        /* Grid */
        .grid { display: grid; grid-template-columns: 320px 1fr; gap: 22px; }

        /* Panels */
        .panel { background: white; border-radius: 16px; box-shadow: 0 2px 12px rgba(0,0,0,0.05); overflow: hidden; }
        .panel-header { padding: 18px 22px; border-bottom: 1px solid #f3f4f6; display: flex; align-items: center; justify-content: space-between; }
        .panel-header h2 { font-size: 0.95rem; font-weight: 700; color: var(--dark); display: flex; align-items: center; gap: 8px; }
        .panel-header h2 i { color: var(--red); }
        .panel-body { padding: 16px 22px; }

        /* Student list */
        .student-item { display: flex; align-items: center; gap: 12px; padding: 10px 0; border-bottom: 1px solid #f9fafb; }
        .student-item:last-child { border-bottom: none; }
        .avatar { width: 36px; height: 36px; border-radius: 50%; background: linear-gradient(135deg, var(--red), #8b0000); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 0.82rem; flex-shrink: 0; }
        .avatar.president { background: linear-gradient(135deg, #f59e0b, #b45309); }
        .student-name { font-size: 0.88rem; font-weight: 600; color: var(--dark); }
        .student-nis { font-size: 0.75rem; color: #9ca3af; }
        .crown-badge { font-size: 0.68rem; background: #fef3c7; color: #92400e; padding: 2px 7px; border-radius: 4px; font-weight: 700; margin-left: 5px; }

        /* Btn set president */
        .btn-set-president { display: inline-flex; align-items: center; gap: 7px; background: #fef3c7; color: #92400e; border: 1px solid #fde68a; padding: 6px 14px; border-radius: 8px; font-size: 0.78rem; font-weight: 700; cursor: pointer; transition: 0.2s; }
        .btn-set-president:hover { background: #fde68a; }

        /* Meetings grid */
        .meetings-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; padding: 18px 22px; }
        .meeting-card { border: 2px solid #f0f0f0; border-radius: 14px; padding: 16px 12px; text-align: center; transition: 0.25s; }
        .meeting-card:hover { border-color: var(--red); box-shadow: 0 4px 15px rgba(227,6,19,0.1); transform: translateY(-2px); }
        .meeting-card.has-data { border-color: #d1fae5; background: #f0fdf4; }
        .meeting-num { font-size: 1.3rem; font-weight: 800; color: var(--dark); line-height: 1; }
        .meeting-label { font-size: 0.68rem; color: #9ca3af; margin: 3px 0 8px; text-transform: uppercase; letter-spacing: 0.5px; }
        .attendance-count { font-size: 0.75rem; font-weight: 700; color: #10b981; margin-bottom: 10px; display: flex; align-items: center; justify-content: center; gap: 4px; }
        .attendance-count.zero { color: #d1d5db; }
        .btn-qr { display: flex; align-items: center; justify-content: center; gap: 5px; background: linear-gradient(135deg, var(--red), #8b0000); color: white; padding: 8px 6px; border-radius: 9px; text-decoration: none; font-weight: 700; font-size: 0.73rem; transition: 0.2s; }
        .btn-qr:hover { opacity: 0.85; transform: translateY(-1px); }

        /* Modal */
        .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center; }
        .modal-overlay.active { display: flex; }
        .modal { background: white; border-radius: 20px; width: 90%; max-width: 420px; overflow: hidden; box-shadow: 0 25px 60px rgba(0,0,0,0.3); animation: slideUp 0.3s ease; }
        @keyframes slideUp { from { transform: translateY(30px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
        .modal-header { background: var(--dark); color: white; padding: 20px 24px; display: flex; align-items: center; justify-content: space-between; }
        .modal-header h3 { font-size: 1rem; font-weight: 700; display: flex; align-items: center; gap: 8px; }
        .modal-close { background: none; border: none; color: white; font-size: 1.2rem; cursor: pointer; opacity: 0.7; transition: 0.2s; }
        .modal-close:hover { opacity: 1; }
        .modal-body { padding: 20px 24px; }
        .modal-body p { font-size: 0.85rem; color: #666; margin-bottom: 14px; }
        .student-select-list { max-height: 300px; overflow-y: auto; border: 2px solid #f0f0f0; border-radius: 12px; }
        .select-item { padding: 12px 16px; cursor: pointer; display: flex; align-items: center; gap: 12px; transition: 0.15s; border-bottom: 1px solid #f9fafb; }
        .select-item:last-child { border-bottom: none; }
        .select-item:hover { background: #fef2f2; }
        .select-item .s-avatar { width: 34px; height: 34px; border-radius: 50%; background: linear-gradient(135deg, var(--red), #8b0000); color: white; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; font-weight: 700; flex-shrink: 0; }
        .select-item .s-name { font-size: 0.88rem; font-weight: 600; color: var(--dark); }
        .select-item .s-nis { font-size: 0.75rem; color: #9ca3af; }
        .select-form { display: none; }
    </style>
</head>
<body>

<!-- Topbar -->
<div class="topbar">
    <div class="topbar-left">
        <img src="{{ asset('images/official_logo.png') }}" alt="Logo">
        <div class="divider"></div>
        <div class="breadcrumb">
            <a href="{{ route('admin.attendance.index') }}">Sistem Absensi</a>
            &nbsp;/&nbsp;
            <span>{{ $subject->name }}</span>
        </div>
    </div>
    <a href="{{ route('admin.attendance.index') }}" class="btn-back">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="container">
    {{-- Alert --}}
    @if(session('success'))
    <div class="alert alert-success">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
    @endif

    <!-- Subject Info -->
    <div class="subject-header">
        <div class="subject-icon"><i class="fas fa-book-open"></i></div>
        <div class="subject-info">
            <h1>{{ $subject->name }}</h1>
            <div class="subject-meta">
                <span class="meta-item"><i class="fas fa-tag"></i> {{ $subject->code }}</span>
                <span class="meta-item"><i class="fas fa-door-open"></i> Kelas <strong>{{ $subject->class_name }}</strong></span>
                <span class="meta-item"><i class="fas fa-chalkboard-teacher"></i> <strong>{{ $subject->teacher_name }}</strong></span>
                <span class="meta-item"><i class="fas fa-users"></i> <strong>{{ $students->count() }}</strong> Siswa</span>
                @if($subject->class_president)
                <span class="president-tag"><i class="fas fa-crown"></i> Ketua: {{ $subject->class_president }}</span>
                @endif
            </div>
        </div>
    </div>

    <!-- Grid -->
    <div class="grid">
        <!-- Sidebar: Students -->
        <div class="panel">
            <div class="panel-header">
                <h2><i class="fas fa-users"></i> Daftar Siswa ({{ $students->count() }})</h2>
                <button class="btn-set-president" onclick="openPresidentModal()">
                    <i class="fas fa-crown"></i> Atur Ketua
                </button>
            </div>
            <div class="panel-body">
                @forelse($students as $student)
                <div class="student-item">
                    <div class="avatar {{ $student->name == $subject->class_president ? 'president' : '' }}">
                        {{ strtoupper(substr($student->name, 0, 1)) }}
                    </div>
                    <div>
                        <div class="student-name">
                            {{ $student->name }}
                            @if($student->name == $subject->class_president)
                            <span class="crown-badge"><i class="fas fa-crown"></i> Ketua</span>
                            @endif
                        </div>
                        <div class="student-nis">NIS: {{ $student->nis }}</div>
                    </div>
                </div>
                @empty
                <p style="color:#9ca3af; text-align:center; padding:20px 0; font-size:0.85rem;">
                    <i class="fas fa-info-circle"></i> Belum ada siswa untuk kelas ini.
                </p>
                @endforelse
            </div>
        </div>

        <!-- Meetings -->
        <div class="panel">
            <div class="panel-header">
                <h2><i class="fas fa-calendar-alt"></i> Pertemuan 1 — 16</h2>
                <span style="font-size:0.78rem; color:#9ca3af;">Klik "Buka QR" untuk memulai absensi</span>
            </div>
            <div class="meetings-grid">
                @for($m = 1; $m <= 16; $m++)
                <div class="meeting-card {{ ($attendanceData[$m] ?? 0) > 0 ? 'has-data' : '' }}">
                    <div class="meeting-num">{{ $m }}</div>
                    <div class="meeting-label">Pertemuan</div>
                    <div class="attendance-count {{ ($attendanceData[$m] ?? 0) == 0 ? 'zero' : '' }}">
                        @if(($attendanceData[$m] ?? 0) > 0)
                        <i class="fas fa-check-circle"></i> {{ $attendanceData[$m] }} hadir
                        @else
                        <i class="fas fa-minus"></i> Belum ada
                        @endif
                    </div>
                    <a href="{{ route('admin.attendance.qr', ['subject_id' => $subject->id, 'meeting' => $m]) }}" class="btn-qr" target="_blank">
                        <i class="fas fa-qrcode"></i> Buka QR
                    </a>
                </div>
                @endfor
            </div>
        </div>
    </div>
</div>

<!-- Modal Pilih Ketua Kelas -->
<div class="modal-overlay" id="presidentModal">
    <div class="modal">
        <div class="modal-header">
            <h3><i class="fas fa-crown"></i> Pilih Ketua Kelas</h3>
            <button class="modal-close" onclick="closePresidentModal()"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <p>Pilih siswa yang akan dijadikan Ketua Kelas untuk mata pelajaran <strong>{{ $subject->name }}</strong>:</p>
            <div class="student-select-list">
                @foreach($students as $student)
                <div class="select-item" onclick="selectPresident('{{ $student->name }}', {{ $student->id }})">
                    <div class="s-avatar">{{ strtoupper(substr($student->name, 0, 1)) }}</div>
                    <div>
                        <div class="s-name">{{ $student->name }}</div>
                        <div class="s-nis">NIS: {{ $student->nis }}</div>
                    </div>
                    @if($student->name == $subject->class_president)
                    <span class="crown-badge" style="margin-left:auto;"><i class="fas fa-crown"></i> Aktif</span>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Hidden Form for submit president -->
<form id="presidentForm" action="{{ route('admin.attendance.set-president', $subject->id) }}" method="POST" class="select-form">
    @csrf
    <input type="hidden" name="class_president" id="presidentInput">
</form>

<script>
    function openPresidentModal() {
        document.getElementById('presidentModal').classList.add('active');
    }
    function closePresidentModal() {
        document.getElementById('presidentModal').classList.remove('active');
    }
    function selectPresident(name, id) {
        document.getElementById('presidentInput').value = name;
        document.getElementById('presidentForm').submit();
    }
    // Close modal on overlay click
    document.getElementById('presidentModal').addEventListener('click', function(e) {
        if (e.target === this) closePresidentModal();
    });
</script>

</body>
</html>
