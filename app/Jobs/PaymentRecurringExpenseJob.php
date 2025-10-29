<?php

namespace App\Jobs;

use App\Models\RecurringExpense;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;

class PaymentRecurringExpenseJob implements ShouldQueue
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
    }
    
}
