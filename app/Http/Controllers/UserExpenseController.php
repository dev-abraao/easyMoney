<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateExpenseRequest;
use App\Models\UserExpense;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(CreateExpenseRequest $request)
    {
        try {
            $validated = $request->validated();

            $expense = UserExpense::create($validated);

            if($expense){
               $userBalance = $expense->user->balance;
                if($userBalance && $userBalance->amount >= $expense->amount) {
                    $userBalance->amount -= $expense->amount;
                    $userBalance->save();
                } else {
                    throw ValidationException::withMessages(['error' => 'Insufficient balance to cover this expense.']);
                }
            }

            if ($request->ajax()){
                return response()->json(['success' => true, 'message' => 'Expense created successfully.', 'data' => $expense], 201);
            }

            return redirect()->back()->with('success', 'Expense created successfully.');
            
        } catch (ValidationException $e) {
            if ($request->ajax()){
                return response()->json(['success' => false, 'errors' => $e->errors()], 422);
            }
            return redirect()->back()->with('error', 'Something went wrong.')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(UserExpense $userExpense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserExpense $userExpense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserExpense $userExpense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserExpense $userExpense)
    {
        //
    }
}
