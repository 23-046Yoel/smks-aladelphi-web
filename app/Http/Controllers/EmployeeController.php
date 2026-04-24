<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    // Public: Halaman pegawai
    public function index()
    {
        $guru = Employee::where('employee_type', 'guru')->where('status', 'aktif')->get();
        $staff = Employee::whereIn('employee_type', ['staff', 'tata_usaha'])->where('status', 'aktif')->get();
        return view('kepegawaian.index', compact('guru', 'staff'));
    }

    // Admin: List semua pegawai
    public function adminIndex()
    {
        $employees = Employee::orderBy('employee_type')->orderBy('name')->paginate(15);
        return view('admin.employees.index', compact('employees'));
    }

    // Admin: Form tambah
    public function create()
    {
        return view('admin.employees.create');
    }

    // Admin: Simpan pegawai baru
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'position'      => 'required',
            'employee_type' => 'required',
            'photo'         => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('employees', 'public');
        }

        Employee::create($data);
        return redirect()->route('admin.employees.index')->with('success', 'Data pegawai berhasil ditambahkan!');
    }

    // Admin: Form edit
    public function edit(Employee $employee)
    {
        return view('admin.employees.edit', compact('employee'));
    }

    // Admin: Update pegawai
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name'          => 'required',
            'position'      => 'required',
            'employee_type' => 'required',
            'photo'         => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();
        if ($request->hasFile('photo')) {
            if ($employee->photo) Storage::disk('public')->delete($employee->photo);
            $data['photo'] = $request->file('photo')->store('employees', 'public');
        }

        $employee->update($data);
        return redirect()->route('admin.employees.index')->with('success', 'Data pegawai berhasil diperbarui!');
    }

    // Admin: Hapus pegawai
    public function destroy(Employee $employee)
    {
        if ($employee->photo) Storage::disk('public')->delete($employee->photo);
        $employee->delete();
        return redirect()->route('admin.employees.index')->with('success', 'Data pegawai berhasil dihapus!');
    }
}
