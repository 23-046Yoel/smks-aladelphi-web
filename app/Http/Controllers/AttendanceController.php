<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Attendance;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Str;

class AttendanceController extends Controller
{
    // ==========================================
    // Seed default data jika masih kosong
    // ==========================================
    private function seedData()
    {
        if (Subject::count() == 0) {
            $subjects = [
                // Kelas X RPL 1
                ['name' => 'Pemrograman Dasar', 'code' => 'PD-XRPL1', 'teacher_name' => 'Ir. Bambang Wijaya, S.Kom', 'class_name' => 'X RPL 1', 'class_president' => 'Ahmad Fauzi'],
                ['name' => 'Basis Data', 'code' => 'BD-XRPL1', 'teacher_name' => 'Siti Aminah, M.Pd', 'class_name' => 'X RPL 1', 'class_president' => 'Ahmad Fauzi'],
                // Kelas X TKJ 1
                ['name' => 'Jaringan Komputer', 'code' => 'JK-XTKJ1', 'teacher_name' => 'Drs. Budi Santoso', 'class_name' => 'X TKJ 1', 'class_president' => 'Rina Agustina'],
                ['name' => 'Sistem Operasi', 'code' => 'SO-XTKJ1', 'teacher_name' => 'Hendra Gunawan, S.T', 'class_name' => 'X TKJ 1', 'class_president' => 'Rina Agustina'],
                // Kelas XI RPL 1
                ['name' => 'Pemrograman Web', 'code' => 'PW-XIRPL1', 'teacher_name' => 'Dewi Kusuma, M.Kom', 'class_name' => 'XI RPL 1', 'class_president' => 'Budi Hartono'],
                ['name' => 'Pemrograman Mobile', 'code' => 'PM-XIRPL1', 'teacher_name' => 'Ir. Bambang Wijaya, S.Kom', 'class_name' => 'XI RPL 1', 'class_president' => 'Budi Hartono'],
                // Kelas XII RPL 1
                ['name' => 'Proyek Perangkat Lunak', 'code' => 'PPL-XIIRPL1', 'teacher_name' => 'Dewi Kusuma, M.Kom', 'class_name' => 'XII RPL 1', 'class_president' => 'Citra Dewi'],
                // Mata pelajaran umum
                ['name' => 'Matematika', 'code' => 'MTK-X', 'teacher_name' => 'Drs. Ahmad, M.Pd', 'class_name' => 'X RPL 1', 'class_president' => 'Ahmad Fauzi'],
                ['name' => 'Bahasa Indonesia', 'code' => 'BIN-XI', 'teacher_name' => 'Ibu Sari, S.Pd', 'class_name' => 'XI RPL 1', 'class_president' => 'Budi Hartono'],
                ['name' => 'Bahasa Inggris', 'code' => 'ENG-XII', 'teacher_name' => 'Mr. John, M.A', 'class_name' => 'XII RPL 1', 'class_president' => 'Citra Dewi'],
            ];
            Subject::insert(array_map(function($s) {
                return array_merge($s, ['created_at' => now(), 'updated_at' => now()]);
            }, $subjects));
        }

        if (Student::count() == 0) {
            $data = [
                ['X RPL 1', 'RPL'], ['X RPL 1', 'RPL'], ['X RPL 1', 'RPL'], ['X RPL 1', 'RPL'], ['X RPL 1', 'RPL'],
                ['X TKJ 1', 'TKJ'], ['X TKJ 1', 'TKJ'], ['X TKJ 1', 'TKJ'], ['X TKJ 1', 'TKJ'], ['X TKJ 1', 'TKJ'],
                ['XI RPL 1', 'RPL'], ['XI RPL 1', 'RPL'], ['XI RPL 1', 'RPL'], ['XI RPL 1', 'RPL'], ['XI RPL 1', 'RPL'],
                ['XII RPL 1', 'RPL'], ['XII RPL 1', 'RPL'], ['XII RPL 1', 'RPL'], ['XII RPL 1', 'RPL'], ['XII RPL 1', 'RPL'],
            ];
            $names = ['Ahmad Fauzi','Budi Santoso','Citra Dewi','Dina Rahayu','Eko Prasetyo',
                      'Fani Putri','Gilang Ramadhan','Hana Safitri','Irfan Hakim','Joko Susilo',
                      'Kartika Sari','Lina Marlina','Muhammad Rizki','Nadia Aulia','Omar Faruq',
                      'Putri Anggraini','Qodri Ananda','Rina Agustina','Sandi Pratama','Tina Wulandari'];
            foreach ($data as $i => $d) {
                Student::create([
                    'nis' => '2024' . str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                    'name' => $names[$i] ?? 'Siswa ' . ($i + 1),
                    'class' => $d[0],
                    'major' => $d[1],
                    'spp_amount' => 150000
                ]);
            }
        }
    }

    // ==========================================
    // Halaman utama: Daftar Mata Pelajaran
    // ==========================================
    public function index()
    {
        $this->seedData();

        // Mengambil semua mata pelajaran dan mengelompokkannya berdasarkan 'class'
        $subjects = Subject::all();
        $subjectsByClass = $subjects->groupBy('class_name');

        // Total absensi hari ini
        $totalAttendances = Attendance::whereDate('created_at', today())->count();

        $attendances = Attendance::with(['subject', 'student'])
            ->orderBy('created_at', 'desc')
            ->take(50)
            ->get();

        return view('admin.attendance.index', compact('subjectsByClass', 'totalAttendances', 'attendances'));
    }

    // ==========================================
    // Detail Mata Pelajaran: Siswa, Pengajar, Pertemuan 1-16
    // ==========================================
    public function detail($subject_id)
    {
        $subject = Subject::findOrFail($subject_id);

        // Ambil siswa berdasarkan kelas (class_name subject = class siswa)
        $students = Student::where('class', $subject->class_name)->get();

        // Hitung kehadiran per pertemuan untuk setiap siswa
        $attendanceData = [];
        for ($meeting = 1; $meeting <= 16; $meeting++) {
            $count = Attendance::where('subject_id', $subject_id)
                ->where('meeting_number', $meeting)
                ->count();
            $attendanceData[$meeting] = $count;
        }

        return view('admin.attendance.detail', compact('subject', 'students', 'attendanceData'));
    }

    // ==========================================
    // Tampilkan QR Code per Pertemuan
    // ==========================================
    public function showQr($subject_id, $meeting = 1)
    {
        $subject = Subject::findOrFail($subject_id);
        $date = date('Y-m-d');

        // URL-safe token using hex
        $token = bin2hex($subject_id . '|' . $meeting . '|' . $date);
        
        // Generate clean absolute URL using route helper
        $scanUrl = route('attendance.scan', ['t' => $token]);

        return view('admin.attendance.qr', compact('subject', 'date', 'scanUrl', 'meeting'));
    }

    // ==========================================
    // Halaman Scan Publik (HP Siswa)
    // ==========================================
    public function scanForm(Request $request)
    {
        $token = $request->query('t');

        if (!$token) {
            abort(400, 'Token QR tidak ditemukan dalam URL.');
        }

        try {
            $decoded    = hex2bin($token);
            $parts      = explode('|', $decoded);

            if (count($parts) < 3) {
                throw new \Exception('Format token tidak valid.');
            }

            $subject_id = $parts[0];
            $meeting    = $parts[1];
            $date       = $parts[2];
            $subject    = Subject::findOrFail($subject_id);
            $students   = Student::where('class', $subject->class_name)->get();

            return view('public.attendance-scan', compact('subject', 'date', 'token', 'meeting', 'students'));

        } catch (\Exception $e) {
            // Tampilkan error langsung di halaman, bukan redirect ke home
            $errMsg = $e->getMessage();
            return response("
                <h2 style='font-family:sans-serif;padding:20px;color:#c00'>QR Error</h2>
                <p style='font-family:sans-serif;padding:20px'>Pesan: {$errMsg}<br><br>Token: {$token}<br><br><a href='/'>Ke Beranda</a></p>
            ", 200);
        }
    }

    // ==========================================
    // Proses Absensi (Submit dari HP Siswa)
    // ==========================================
    public function submitScan(Request $request)
    {
        $request->validate(['nis' => 'required|string']);
        $token = $request->query('t');

        try {
            $decoded = hex2bin($token);
            $parts = explode('|', $decoded);
            $subject_id = $parts[0];
            $meeting    = $parts[1];
            $date       = $parts[2];

            $student = Student::where('nis', $request->nis)->first();

            if (!$student) {
                return back()->with('error', 'Siswa dengan NIS ' . $request->nis . ' tidak ditemukan dalam sistem.');
            }

            // Cek apakah sudah absen di pertemuan ini
            $exists = Attendance::where('student_id', $student->id)
                ->where('subject_id', $subject_id)
                ->where('meeting_number', $meeting)
                ->exists();

            if ($exists) {
                return back()->with('warning', 'Halo ' . $student->name . '! Anda sudah melakukan absensi untuk Pertemuan ke-' . $meeting . ' ini.');
            }

            Attendance::create([
                'student_id'     => $student->id,
                'subject_id'     => $subject_id,
                'meeting_number' => $meeting,
                'date'           => $date,
                'status'         => 'hadir',
                'scanned_at'     => now(),
            ]);

            return back()->with('success', 'Berhasil! ' . $student->name . ' (' . $student->class . ') telah tercatat HADIR pada Pertemuan ke-' . $meeting . ' pukul ' . now()->format('H:i') . ' WIB.');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    // ==========================================
    // Set Ketua Kelas
    // ==========================================
    public function setPresident(Request $request, $subject_id)
    {
        $request->validate(['class_president' => 'required|string']);
        $subject = Subject::findOrFail($subject_id);
        $subject->class_president = $request->class_president;
        $subject->save();
        return redirect()->route('admin.attendance.detail', $subject_id)
            ->with('success', $request->class_president . ' berhasil ditetapkan sebagai Ketua Kelas.');
    }
}
