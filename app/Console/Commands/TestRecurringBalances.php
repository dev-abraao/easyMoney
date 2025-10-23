<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\RecurringBalance;

class TestRecurringBalances extends Command
{
    protected $signature = 'test:recurring-balances';
    protected $description = 'Test recurring balances processing';

    public function handle()
    {
        $this->info('Processing recurring balances...');

        DB::transaction(function () {
            $balances = RecurringBalance::where('next_due_date', '=', now()->toDateString())->get();

            $this->info("Found {$balances->count()} balances to process");

            foreach ($balances as $balance) {   
                $oldBalance = $balance->user->balance->balance_amount;
                
                $balance->user->balance->increment('balance_amount', $balance->rec_bal_amount);

                $balance->next_due_date = match ($balance->frequency) {
                    'daily' => now()->addDay(),
                    'weekly' => now()->addWeek(),
                    'monthly' => now()->addMonth(),
                    'yearly' => now()->addYear(),
                };

                $balance->save();

                $this->line("✓ Processed: {$balance->name}");
                $this->line("  Old balance: {$oldBalance}");
                $this->line("  New balance: {$balance->user->balance->balance_amount}");
                $this->line("  Next due: {$balance->next_due_date}");
            }
        });

        $this->info('Done!');
    }
}