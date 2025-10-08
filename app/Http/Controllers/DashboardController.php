<?php

namespace App\Http\Controllers;

use App\Models\ExpenseTypes;
use App\Models\UserExpense;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        $userExpenses = UserExpense::where('user_id', auth()->id())
            ->with('type') // Eager load the related expense type
            ->orderBy('created_at', 'desc')
            ->get();
        return view('dashboard', ['expenses' => $userExpenses]);
    }
}
