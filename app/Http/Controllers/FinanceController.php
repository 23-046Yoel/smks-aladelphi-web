<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\FinanceTransaction;
use App\Models\SppPayment;
use App\Models\Student;

class FinanceController extends Controller
{
    public function adminIndex()
    {
        $transactions = FinanceTransaction::orderBy('transaction_date', 'desc')->get();
        $totalIncome = FinanceTransaction::where('type', 'income')->sum('amount');
        $totalExpense = FinanceTransaction::where('type', 'expense')->sum('amount');
        $balance = $totalIncome - $totalExpense;

        return view('admin.finance.index', compact('transactions', 'totalIncome', 'totalExpense', 'balance'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:1',
            'description' => 'required|string|max:255',
            'transaction_date' => 'required|date',
        ]);

        FinanceTransaction::create([
            'type' => $request->type,
            'amount' => $request->amount,
            'description' => $request->description,
            'transaction_date' => $request->transaction_date,
            'user_id' => null, // If using Auth: auth()->id()
        ]);

        return redirect()->back()->with('success', 'Transaksi berhasil disimpan!');
    }

    public function adminSppIndex(Request $request)
    {
        $students = Student::all();
        $selectedStudent = null;
        $payments = [];

        if ($request->has('nis')) {
            $selectedStudent = Student::where('nis', $request->nis)->first();
            if ($selectedStudent) {
                $currentYear = date('Y');
                $payments = SppPayment::where('student_id', $selectedStudent->id)
                                      ->where('year', $currentYear)
                                      ->orderBy('month', 'asc')
                                      ->get()
                                      ->keyBy('month');
            }
        }

        return view('admin.finance.spp', compact('students', 'selectedStudent', 'payments'));
    }

    public function storeStudent(Request $request)
    {
        $request->validate([
            'nis' => 'required|string|unique:students,nis',
            'name' => 'required|string|max:255',
            'class' => 'required|string|max:50',
            'major' => 'required|string|max:100',
            'spp_amount' => 'required|numeric|min:0',
        ]);

        Student::create($request->all());

        return redirect()->route('admin.spp.index', ['nis' => $request->nis])->with('success', 'Data siswa berhasil ditambahkan!');
    }

    public function storeSpp(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer',
            'amount' => 'required|numeric',
        ]);

        SppPayment::create([
            'student_id' => $request->student_id,
            'month' => $request->month,
            'year' => $request->year,
            'amount' => $request->amount,
            'payment_date' => now(),
            'status' => 'paid',
            'user_id' => null, // auth()->id() later
        ]);

        return redirect()->back()->with('success', 'Pembayaran SPP berhasil dicatat!');
    }

    public function publicCekSpp(Request $request)
    {
        $student = null;
        $payments = [];

        if ($request->has('nis')) {
            $student = Student::where('nis', $request->nis)->first();
            if ($student) {
                // Get payments for the current year
                $currentYear = date('Y');
                $payments = SppPayment::where('student_id', $student->id)
                                      ->where('year', $currentYear)
                                      ->orderBy('month', 'asc')
                                      ->get()
                                      ->keyBy('month');
            }
        }

        return view('public.cek-spp', compact('student', 'payments'));
    }
}
