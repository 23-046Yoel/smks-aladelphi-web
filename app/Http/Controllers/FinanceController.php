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
}
