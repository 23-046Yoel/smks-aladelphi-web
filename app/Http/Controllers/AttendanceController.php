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
    // Halaman utama: Daftar Mata Pelajaran
    // ==========================================
    public function index()
    {
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
