<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request) {
        // Simplified login logic for demo
        return redirect()->route('admin.dashboard');
    }

    public function adminDashboard() {
        $teacherCount = \App\Models\Employee::where('employee_type', 'guru')->count();
        $studentCount = \App\Models\Student::count();
        
        return view('admin.dashboard', compact('teacherCount', 'studentCount'));
    }
}
