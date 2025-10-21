<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRecurringBalanceRequest;
use App\Models\RecurringBalance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Throwable;

class RecurringBalanceController extends Controller
{
    public function index()
    {
        $userRecurringBalances = auth()->user()->recurringBalances;
        return view('recurringbalances.index', [
            'frequencies' => \App\Frequency::cases(),
            'recurringBalances' => $userRecurringBalances
        ]);
    }

    public function store(CreateRecurringBalanceRequest $request)
    {
        try {
            $nextPayDate = $this->calculateNextPayDate($request->frequency, $request->payment_day ? (int)$request->payment_day : null, $request->payment_month ? (int)$request->payment_month : null);

            RecurringBalance::create([
                'user_id' => auth()->id(),
                'name' => $request->name,
                'description' => $request->description,
                'rec_bal_amount' => $request->rec_bal_amount,
                'frequency' => $request->frequency,
                'next_due_date' => $nextPayDate,
            ]);

            return redirect()->back()->with('success', 'Recurring balance created successfully!');
        } catch(Throwable $e) {
            return redirect()->back()->with('error', 'Failed to create recurring balance: ' . $e->getMessage());
        }

    }

    private function calculateNextPayDate($frequency, $paymentDay = null, $paymentMonth = null)
    {
        $now = Carbon::now();

        return match ($frequency) {
            'daily' => $now->addDay(),
            'weekly' => $now->addWeek(),
            'monthly' => $this->getNextOccurrence($now, $paymentDay ?? $now->day, $now->month, 'month'),
            'yearly' => $this->getNextOccurrence($now, $paymentDay ?? $now->day, $paymentMonth ?? $now->month, 'year'),
        };
    }

    private function getNextOccurrence(Carbon $now, int $day, int $month, string $period): Carbon
{
    $nextDate = $now->copy()->setMonth($month)->setDay($day);
    
    if ($nextDate->lte($now)) {
        $nextDate = $period === 'month' ? $nextDate->addMonth() : $nextDate->addYear();
    }
    
    return $nextDate;
}

}
