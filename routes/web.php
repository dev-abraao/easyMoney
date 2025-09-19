<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserBalanceController;
use Illuminate\Support\Facades\Route;

// Currently, only the login.view and dashboard routes utilize middleware. Additional routes should be incorporated as necessary.

Route::view('/', 'welcome')->name('login.view')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::view('/register', 'auth.register')->name('register.view');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::view('/dashboard', 'dashboard')->name('dashboard')->middleware('auth');
Route::post('/user-balance', [UserBalanceController::class, 'store'])->name('user.balance.store');