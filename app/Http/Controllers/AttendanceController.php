<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Attendance;
use App\Models\Student;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index()
    {
        // Seed default subjects if empty
        if (Subject::count() == 0) {
            Subject::insert([
                ['name' => 'Matematika', 'code' => 'MTK', 'teacher_name' => 'Guru Matematika'],
                ['name' => 'Bahasa Indonesia', 'code' => 'BIN', 'teacher_name' => 'Guru B. Indonesia'],
                ['name' => 'Bahasa Inggris', 'code' => 'ENG', 'teacher_name' => 'Guru B. Inggris'],
                ['name' => 'Pendidikan Agama', 'code' => 'AGM', 'teacher_name' => 'Guru Agama'],
                ['name' => 'Produktif Kejuruan', 'code' => 'PROD', 'teacher_name' => 'Instruktur Kejuruan'],
                ['name' => 'Pendidikan Jasmani', 'code' => 'PJOK', 'teacher_name' => 'Guru Olahraga'],
            ]);
        }

        $subjects = Subject::all();
        $recentAttendances = Attendance::with(['student', 'subject'])->orderBy('scanned_at', 'desc')->take(20)->get();
        return view('admin.attendance.index', compact('subjects', 'recentAttendances'));
    }

    // This route shows the QR code for a subject
    public function showQr($subject_id)
    {
        $subject = Subject::findOrFail($subject_id);
        $date = date('Y-m-d');
        // Simple token for demonstration: base64 of subject_id|date
        $token = base64_encode($subject_id . '|' . $date);
        
        $scanUrl = route('attendance.scan', ['token' => $token]);
        
        return view('admin.attendance.qr', compact('subject', 'date', 'scanUrl'));
    }

    // Public route for students to scan and enter NIS
    public function scanForm($token)
    {
        try {
            $decoded = base64_decode($token);
            list($subject_id, $date) = explode('|', $decoded);
            $subject = Subject::findOrFail($subject_id);
            
            // Check if the QR date matches today (optional security)
            if ($date != date('Y-m-d')) {
                return redirect('/')->with('error', 'Kode QR sudah kadaluarsa.');
            }
            
            return view('public.attendance-scan', compact('subject', 'date', 'token'));
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Kode QR tidak valid.');
        }
    }

    // Process the scanned attendance
    public function submitScan(Request $request, $token)
    {
        $request->validate(['nis' => 'required|string']);
        
        try {
            $decoded = base64_decode($token);
            list($subject_id, $date) = explode('|', $decoded);
            
            $student = Student::where('nis', $request->nis)->first();
            
            if (!$student) {
                return back()->with('error', 'Siswa dengan NIS tersebut tidak ditemukan.');
            }
            
            // Check if already attended
            $exists = Attendance::where('student_id', $student->id)
                ->where('subject_id', $subject_id)
                ->where('date', $date)
                ->exists();
                
            if ($exists) {
                return back()->with('success', 'Halo ' . $student->name . ', Anda sudah melakukan absensi untuk mata pelajaran ini hari ini.');
            }
            
            Attendance::create([
                'student_id' => $student->id,
                'subject_id' => $subject_id,
                'date' => $date,
                'status' => 'hadir',
                'scanned_at' => now(),
            ]);
            
            return back()->with('success', 'Berhasil! Absensi atas nama ' . $student->name . ' telah tercatat.');
            
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan sistem.');
        }
    }
}
