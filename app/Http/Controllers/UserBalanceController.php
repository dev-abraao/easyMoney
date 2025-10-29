<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBalanceRequest;
use App\Http\Requests\UpdateBalanceRequest;
use App\Models\UserBalance;
use App\Models\UserPayment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Throwable;

class UserBalanceController extends Controller
{
    public function store(CreateBalanceRequest $request)
    {
        if(Auth::user()->balance){
            return response()->json(['success' => false, 'message' => 'Balance already exists.']);
        }

        try {
            $userBalance = UserBalance::create([
                'user_id' => auth()->id(),
                'balance_amount' => $request->balance_amount
            ]);

            if (!$userBalance) {
                throw ValidationException::withMessages(['error' => 'Failed to create balance.']);
            }

            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Balance created successfully.']);
            }

            return redirect()->route('dashboard')->with('success', 'Balance created successfully.');
        } catch(ValidationException $e){
            if ($request->ajax()){
                return response()->json(['success' => false, 'errors' => $e->errors()], 422);
            }

            return redirect()->back()->withErrors('Something went wrong.')->withInput();
        }
    }

    public function update(UpdateBalanceRequest $request){
        try {
            $userBalance = auth()->user()->balance;

            if (!$userBalance) {
                throw ValidationException::withMessages(['error' => 'User has no balance available.']);
            }

            DB::transaction(function() use ($request, $userBalance) {
                UserPayment::create([
                    'user_id' => auth()->id(),
                    'description' => $request->description,
                    'payment_amount' => $request->payment_amount,
                    'date' => $request->date,
                ]);

                $userBalance->increment('balance_amount', $request->payment_amount);
            });

            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Payment added successfully.']);
            }

            return redirect()->back()->with('success', 'Payment added successfully.');

        }  catch (ValidationException $e) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'An error occurred.'], 422);
            }

            return redirect()->back()->with('error', 'Something went wrong.')->withInput();

        } catch (Throwable $e) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'An error occurred.'], 500);
            }

            return redirect()->back()->with('error', 'Something went wrong.')->withInput();
        }
    }
}
