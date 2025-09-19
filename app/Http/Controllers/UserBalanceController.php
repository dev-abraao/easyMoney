<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBalanceRequest;
use App\Models\UserBalance;
use Illuminate\Http\Request;

class UserBalanceController
{
    public function store(CreateBalanceRequest $request)
    {
        $request->validated();

        UserBalance::create([
            'user_id' => auth()->id(),
            'amount' => $request->input('amount'),
        ]);

    }
}
