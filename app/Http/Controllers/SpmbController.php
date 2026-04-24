<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Registration;
use Illuminate\Support\Str;

class SpmbController extends Controller
{
    // Public: SPMB Info Page
    public function index()
    {
        return view('spmb.index');
    }

    // Public: Registration Form
    public function create()
    {
        return view('spmb.create');
    }

    // Public: Store Registration
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'previous_school' => 'required',
            'major' => 'required',
            'address' => 'required',
        ]);

        $regNumber = 'REG-' . date('Ymd') . '-' . strtoupper(Str::random(4));

        Registration::create(array_merge($request->all(), [
            'registration_number' => $regNumber
        ]));

        return redirect()->route('spmb.create')->with('success', 'Pendaftaran berhasil! Nomor Registrasi Anda: ' . $regNumber);
    }

    // Admin: List Registrants
    public function adminIndex()
    {
        $registrations = Registration::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.registrations.index', compact('registrations'));
    }

    // Admin: Update Status
    public function updateStatus(Request $request, Registration $registration)
    {
        $registration->update(['status' => $request->status]);
        return back()->with('success', 'Status pendaftaran berhasil diperbarui!');
    }
}
