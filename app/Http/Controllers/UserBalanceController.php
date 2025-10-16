<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBalanceRequest;
use App\Models\UserBalance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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
        
    }
}
