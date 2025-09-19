<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBalanceRequest;
use App\Models\UserBalance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserBalanceController extends Controller
{
    public function store(CreateBalanceRequest $request)
{

    if(Auth::user()->balance){
        return response()->json(['success' => false, 'message' => 'Balance already exists.']);
    }
    
        $request->validated();

        UserBalance::create([
            'user_id' => auth()->id(),
            'amount' => $request->input('amount'),
        ]);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Balance created successfully.']);
        }

        return redirect()->route('dashboard')->with('success', 'Balance created successfully.');
    }
}
