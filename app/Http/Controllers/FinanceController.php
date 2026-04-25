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
