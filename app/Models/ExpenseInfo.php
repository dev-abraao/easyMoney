<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ExpenseInfo extends Model
{
    use HasUuids;

    protected $fillable = [
        'user_expense_id',
        'card_id',
        'installments', 
        'installment_amount',
        'remaining_installments', 
        'next_due_date',
        'is_completed'
    ];

    public function userExpense()
{
    return $this->belongsTo(UserExpense::class);
}

    public function card()
{
    return $this->belongsTo(Card::class);
    }
}
