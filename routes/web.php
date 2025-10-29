<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RecurringBalanceController;
use App\Http\Controllers\RecurringExpenseController;
use App\Http\Controllers\UserBalanceController;
use App\Http\Controllers\UserExpenseController;
use App\Http\Controllers\CardController;
use Illuminate\Support\Facades\Route;

// Currently, only the login.view and dashboard routes utilize middleware. Additional routes should be incorporated as necessary.

Route::view('/', 'welcome')->name('login.view')->middleware('guest');
Route::view('/register', 'auth.register')->name('register.view');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/user-balance', [UserBalanceController::class, 'store'])->name('user.balance.store');
Route::put('/user-balance', [UserBalanceController::class, 'update'])->name('user.balance.update');

Route::resource('user-expense', UserExpenseController::class)->only(['store', 'destroy']);

Route::resource('recurring/expenses', RecurringExpenseController::class)->names('recurring.expenses')->only(['index', 'store']);

Route::resource('recurring/balances', RecurringBalanceController::class)->names('recurring.balances')->only(['index', 'store']);

Route::resource('cards', CardController::class)->names('cards')->only(['index', 'store']);
