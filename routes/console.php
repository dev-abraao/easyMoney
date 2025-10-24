<?php

use App\Jobs\PaymentInstallmentJob;
use App\Jobs\PaymentRecurringBalanceJob;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\DB;
use App\Models\RecurringBalance;
use App\Models\RecurringExpense;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


// Add Recurring Balances to the account balance and update next due date
Schedule::call(PaymentRecurringBalanceJob::class)->daily();

// Subtract recurring expenses from the account balance and update next due date
Schedule::call(function () {
    DB::transaction(function () {
        $expenses = RecurringExpense::where('next_due_date', '=', now()->toDateString())->get();

        foreach($expenses as $expense){
            $expense->user->balance->decrement('balance_amount', $expense->rec_ex_amount);

            $expense->next_due_date = match ($expense->frequency) {
                'daily' => now()->addDay(),
                'weekly' => now()->addWeek(),
                'monthly' => now()->addMonth(),
                'yearly' => now()->addYear(),
            };

            $expense->save();
        }
    });
})->daily();

// Card Payments processing
Schedule::job(PaymentInstallmentJob::class)->daily();