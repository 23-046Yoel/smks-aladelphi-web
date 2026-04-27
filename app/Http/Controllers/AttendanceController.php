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
    public function index()
    {
        // Seed default subjects if empty
        if (Subject::count() == 0) {
            Subject::insert([
                ['name' => 'Matematika', 'code' => 'MTK-01', 'teacher_name' => 'Drs. Budi Santoso'],
                ['name' => 'Bahasa Indonesia', 'code' => 'BIN-01', 'teacher_name' => 'Siti Aminah, M.Pd'],
                ['name' => 'Bahasa Inggris', 'code' => 'ENG-01', 'teacher_name' => 'John Doe, MA'],
                ['name' => 'Pendidikan Agama', 'code' => 'AGM-01', 'teacher_name' => 'H. Ahmad Fauzi'],
                ['name' => 'Produktif Kejuruan', 'code' => 'PROD-01', 'teacher_name' => 'Ir. Bambang Wijaya'],
                ['name' => 'Pendidikan Jasmani', 'code' => 'PJOK-01', 'teacher_name' => 'Anto Suherman, S.Pd'],
            ]);
        }

        // Seed some students if empty so the system "really works"
        if (Student::count() == 0) {
            $majors = ['RPL', 'TKJ', 'Multimedia', 'Akuntansi'];
            $classes = ['X', 'XI', 'XII'];
            
            for ($i = 1; $i <= 50; $i++) {
                Student::create([
                    'nis' => '2024' . str_pad($i, 4, '0', STR_PAD_LEFT),
                    'name' => 'Siswa Contoh ' . $i,
                    'class' => $classes[array_rand($classes)],
                    'major' => $majors[array_rand($majors)],
                    'spp_amount' => 150000
                ]);
            }
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
        // Simple token for security: base64 of subject_id|date|salt
        $token = base64_encode($subject_id . '|' . $date . '|' . Str::random(5));
        
        $scanUrl = route('attendance.scan', ['token' => $token]);
        
        return view('admin.attendance.qr', compact('subject', 'date', 'scanUrl'));
    }

    // Public route for students to scan and enter NIS
    public function scanForm($token)
    {
        try {
            $decoded = base64_decode($token);
            $parts = explode('|', $decoded);
            $subject_id = $parts[0];
            $date = $parts[1];
            
            $subject = Subject::findOrFail($subject_id);
            
            // Optional: Check if the QR date matches today
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
            $parts = explode('|', $decoded);
            $subject_id = $parts[0];
            $date = $parts[1];
            
            $student = Student::where('nis', $request->nis)->first();
            
            if (!$student) {
                return back()->with('error', 'Siswa dengan NIS ' . $request->nis . ' tidak ditemukan dalam sistem kami.');
            }
            
            // Check if already attended for this subject today
            $exists = Attendance::where('student_id', $student->id)
                ->where('subject_id', $subject_id)
                ->where('date', $date)
                ->exists();
                
            if ($exists) {
                return back()->with('success', 'Halo ' . $student->name . '! Anda sudah melakukan absensi untuk mata pelajaran ' . Subject::find($subject_id)->name . ' hari ini.');
            }
            
            Attendance::create([
                'student_id' => $student->id,
                'subject_id' => $subject_id,
                'date' => $date,
                'status' => 'hadir',
                'scanned_at' => now(),
            ]);
            
            return back()->with('success', 'Berhasil! Absensi ' . $student->name . ' (' . $student->class . ' ' . $student->major . ') telah tercatat pada ' . now()->format('H:i') . '.');
            
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan sistem saat memproses absensi.');
        }
    }
}

