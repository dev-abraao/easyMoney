<?php

namespace App\Http\Controllers;

use App\Models\ExpenseTypes;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $expenseTypes = ExpenseTypes::all();

        return view('dashboard', ['expenseTypes' => $expenseTypes]);
    }
}
