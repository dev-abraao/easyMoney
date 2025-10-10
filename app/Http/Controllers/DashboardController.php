<?php

namespace App\Http\Controllers;

use App\Models\ExpenseTypes;
use App\Models\UserExpense;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        $latestExpenses = UserExpense::where('user_id', auth()->id())
            ->with('type') 
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $expensesCount = auth()->user()->expenses()->count();
        return view('dashboard', ['expenses' => $latestExpenses, 'expensesCount' => $expensesCount]);
    }
}
