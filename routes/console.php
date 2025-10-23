<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\DB;
use App\Models\RecurringBalance;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


// Add Recurring Balances to the account balance
Schedule::call(function () {
    DB::transaction(function () {
        $balances = RecurringBalance::where('next_due_date', '=', now()->toDateString())->get();

        foreach ($balances as $balance) {   
            $balance->user->balance->increment('balance_amount', $balance->rec_bal_amount);

            $balance->next_due_date = match ($balance->frequency) {
                'daily' => now()->addDay(),
                'weekly' => now()->addWeek(),
                'monthly' => now()->addMonth(),
                'yearly' => now()->addYear(),
            };

            $balance->save();
        }
    });
})->daily();