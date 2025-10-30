<?php

namespace App\Http\Controllers;

use App\Http\Requests\CardStoreRequest;
use App\Models\Card;
use Illuminate\Http\Request;
use Throwable;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cards = auth()->user()->cards;
        return view('cards.index', ['cards' => $cards]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CardStoreRequest $request)
    {
        $existingCard = Card::where('user_id', auth()->id())
            ->where('last4', $request->last4)
            ->first();

        if ($existingCard) {
            return redirect()->route('cards.index')->with('error', 'This card already exists.');
        }

        try {
            Card::create([
                'user_id' => auth()->id(),
                'name' => $request->name,
                'last4' => $request->last4,
                'limit' => $request->limit,
                'closing_day' => $request->closing_day,
                'due_day' => $request->due_day,
            ]);
        }catch(Throwable $e){
            return redirect()->route('cards.index')->with('error', 'An error occurred while adding the card.');
        }

        return redirect()->route('cards.index')->with('success', 'Card added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Card $card)
{
        if ($card->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $regularExpenses = $card->expenses()
            ->with(['type', 'info'])
            ->orderBy('date', 'desc')
            ->get();

        $recurringExpenses = $card->recurringExpenses()
            ->orderBy('next_due_date', 'desc')
            ->get();

        $totalSpent = $regularExpenses->sum('amount') + $recurringExpenses->sum('rec_ex_amount');
        $totalRecurring = $recurringExpenses->sum('rec_ex_amount');
        $remainingLimit = $card->limit - $totalSpent;
        $utilizationPercentage = $card->limit > 0 ? ($totalSpent / $card->limit) * 100 : 0;

        return view('cards.show', [
            'card' => $card,
            'regularExpenses' => $regularExpenses,
            'recurringExpenses' => $recurringExpenses,
            'totalSpent' => $totalSpent,
            'totalRecurring' => $totalRecurring,
            'remainingLimit' => $remainingLimit,
            'utilizationPercentage' => $utilizationPercentage,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Card $card)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Card $card)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Card $card)
    {
        //
    }
}
