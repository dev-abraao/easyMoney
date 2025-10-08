<?php

namespace App\Http\Controllers;

use App\Models\ExpenseTypes;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        $userExpenses = auth()->user()->expenses;
        return view('dashboard', ['expenses' => $userExpenses]);
    }
}
