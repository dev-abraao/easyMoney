<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRecurringBalanceRequest;
use App\Models\RecurringBalance;
use App\Traits\CalculateRecurringDates;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Throwable;

class RecurringBalanceController extends Controller
{
    use CalculateRecurringDates;

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
            $nextPayDate = $this->calculateNextDate($request->frequency, $request->payment_day ?? null, $request->payment_month ?? null);

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

    public function destroy(RecurringBalance $balance){
        if ($balance->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        try {
            $balance->delete();
        } catch (Throwable $e) {
            return redirect()->back()->with('error', 'Failed to delete recurring balance: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Recurring balance deleted successfully!');
    }
}
