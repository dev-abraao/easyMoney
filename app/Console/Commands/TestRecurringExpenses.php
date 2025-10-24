<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\RecurringExpense;

class TestRecurringExpenses extends Command
{
    protected $signature = 'test:recurring-expenses';
    protected $description = 'Process recurring expenses and update user balances';

    public function handle()
    {
        $this->info('Processing recurring expenses...');

        DB::transaction(function () {
            $expenses = RecurringExpense::where('next_due_date', '=', now()->toDateString())->get();

            $this->info("Found {$expenses->count()} expenses to process");

            foreach ($expenses as $expense) {
                $oldBalance = $expense->user->balance->balance_amount;
                
                $expense->user->balance->decrement('balance_amount', $expense->rec_ex_amount);

                $expense->next_due_date = match ($expense->frequency) {
                    'daily' => now()->addDay(),
                    'weekly' => now()->addWeek(),
                    'monthly' => now()->addMonth(),
                    'yearly' => now()->addYear(),
                };

                $expense->save();

                $newBalance = $expense->user->balance->balance_amount;
                
                $this->line("✓ {$expense->name}: {$oldBalance} → {$newBalance} (-{$expense->rec_ex_amount})");
                $this->line("  Next due: {$expense->next_due_date}");
            }
        });

        $this->info('Done!');
        
    }
}