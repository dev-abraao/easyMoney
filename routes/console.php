<?php

use App\Jobs\PaymentInstallmentJob;
use App\Jobs\PaymentRecurringBalanceJob;
use App\Jobs\PaymentRecurringExpenseJob;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


// Add Recurring Balances to the account balance and update next due date
Schedule::job(PaymentRecurringBalanceJob::class)->daily();

// Subtract recurring expenses from the account balance and update next due date
Schedule::job(PaymentRecurringExpenseJob::class)->daily();

// Card Payments processing
Schedule::job(PaymentInstallmentJob::class)->daily();