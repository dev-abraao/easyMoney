<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRecurringExpenseRequest;
use App\Models\RecurringExpense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Throwable;

class RecurringExpenseController extends Controller
{
    public function index()
    {
        $userRecurringExpenses = auth()->user()->recurringExpenses;
        $userCards = auth()->user()->cards;
        return view('recurringexpenses.index', ['frequencies' => \App\Frequency::cases(), 'recurringExpenses' => $userRecurringExpenses, 'userCards' => $userCards]);
    }

    public function store(CreateRecurringExpenseRequest $request)
    {
        try {
            $nextDueDate = $this->calculateNextDueDate($request->frequency);

            RecurringExpense::create([
                'user_id' => auth()->id(),
                'name' => $request->name,
                'description' => $request->description,
                'rec_ex_amount' => $request->rec_ex_amount,
                'frequency' => $request->frequency,
                'card_id' => $request->card_id,
                'next_due_date' => $nextDueDate,
            ]);

            return redirect()->back()->with('success', 'Recurring expense created successfully!');
        } catch(Throwable $e) {
            return redirect()->back()->with('error', 'Failed to create recurring expense: ' . $e->getMessage());
        }

    }

    private function calculateNextDueDate($frequency)
    {
        $now = Carbon::now();

        return match ($frequency) {
            'daily' => $now->addDay(),
            'weekly' => $now->addWeek(),
            'monthly' => $now->addMonth(),
            'yearly' => $now->addYear(),
        };
    }

}
