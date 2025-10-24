<?php

namespace App\Jobs;

use App\Models\Card;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;

class PaymentInstallmentJob implements ShouldQueue
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
         $cards = Card::where('due_day', '=', now()->day)->with(['expenses' => function ($q) {
            $q->whereHas('info', function ($q2) {
                $q2->where('is_completed', false);
            });
        }])->get();;

        foreach($cards as $card){
            $cardExpenses = $card->expenses;
            foreach($cardExpenses as $expense){
                DB::transaction(function () use ($expense) {
                    $expense->info->remaining_installments -= 1;
                    if ($expense->info->remaining_installments <= 0) {
                        $expense->info->is_completed = true;
                    } else {
                        $expense->info->next_due_date = now()->addMonth();
                    }
                    $expense->user->balance->decrement('balance_amount', $expense->info->installment_amount);
                    $expense->info->save();
                });
            }
        }
    }
}
