<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateExpenseRequest;
use App\Models\UserExpense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Throwable;

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
            $validated['user_id'] = auth()->id();
            $userBalance = auth()->user()->balance;

            if (!$userBalance) {
                throw ValidationException::withMessages(['error' => 'User has no balance available.']);
            }

            if ($validated['amount'] > $userBalance->amount) {
                throw ValidationException::withMessages(['error' => 'Insufficient balance to cover this expense.']);
            }
            $expense = DB::transaction(function () use ($validated, $userBalance) {
                $expense = UserExpense::create($validated);
                $userBalance->amount -= $expense->amount;
                $userBalance->save();
                return $expense;
            });

            if ($request->ajax()){
                return response()->json(['success' => true, 'message' => 'Expense created successfully.', 'data' => $expense], 201);
            }

            return redirect()->back()->with('success', 'Expense created successfully.');
            
        } catch (ValidationException $e) {
            if ($request->ajax()){
                return response()->json(['success' => false, 'errors' => $e->errors()], 422);
            }
            return redirect()->back()->with('error', 'Something went wrong.')->withInput();
        } catch (Throwable $e) {
            if ($request->ajax()){
                return response()->json(['success' => false, 'errors' => 'An unexpected error occurred. Please try again later.'], 500);
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
