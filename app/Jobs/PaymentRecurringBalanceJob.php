<?php

namespace App\Jobs;

use App\Models\RecurringBalance;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;

class PaymentRecurringBalanceJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
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
    }
}
