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

        // Group subjects by class
        $subjectsByClass = Subject::all()->groupBy('class_name');
        $totalAttendances = Attendance::whereDate('date', today())->count();

        return view('admin.attendance.index', compact('subjectsByClass', 'totalAttendances'));
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
        // Use index.php fallback for servers with missing rewrite rules
        $scanUrl = url('/index.php/pindai/absen') . '?t=' . $token;

        return view('admin.attendance.qr', compact('subject', 'date', 'scanUrl', 'meeting'));
    }

    // ==========================================
    // Halaman Scan Publik (HP Siswa)
    // ==========================================
    public function scanForm(Request $request)
    {
        try {
            $token = $request->query('t');
            if (!$token) return redirect('/')->with('error', 'Token tidak ditemukan.');
            $decoded = hex2bin($token);
            $parts = explode('|', $decoded);
            $subject_id = $parts[0];
            $meeting    = $parts[1];
            $date       = $parts[2];

            $subject = Subject::findOrFail($subject_id);

            if ($date != date('Y-m-d')) {
                return redirect('/')->with('error', 'Kode QR sudah kadaluarsa. Minta guru untuk menampilkan QR baru.');
            }

            $students = Student::where('class', $subject->class_name)->get();

            return view('public.attendance-scan', compact('subject', 'date', 'token', 'meeting', 'students'));
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Kode QR tidak valid: ' . $e->getMessage());
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
