<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RecurringBalanceController;
use App\Http\Controllers\RecurringExpenseController;
use App\Http\Controllers\UserBalanceController;
use App\Http\Controllers\UserExpenseController;
use Illuminate\Support\Facades\Route;

// Currently, only the login.view and dashboard routes utilize middleware. Additional routes should be incorporated as necessary.

Route::view('/', 'welcome')->name('login.view')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::view('/register', 'auth.register')->name('register.view');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::post('/user-balance', [UserBalanceController::class, 'store'])->name('user.balance.store');

Route::post('/user-expense', [UserExpenseController::class, 'store'])->name('user.expense.store');
Route::delete('/user-expense/{userExpense}', [UserExpenseController::class, 'destroy'])->name('user.expense.destroy');

Route::get('/recurring/expenses', [RecurringExpenseController::class, 'index'])->name('recurring.expenses.index');
Route::post('/recurring/expenses', [RecurringExpenseController::class, 'store'])->name('recurring.expenses.store');

Route::get('/recurring/balances', [RecurringBalanceController::class, 'index'])->name('recurring.balances.index');
Route::post('/recurring/balances', [RecurringBalanceController::class, 'store'])->name('recurring.balances.store');