<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'name',
        'last4',
        'brand',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function expenses()
    {
        return $this->hasMany(UserExpense::class);
    }

    public function recurringExpenses()
    {
        return $this->hasMany(RecurringExpense::class);
    }

        // Accessor that returns all expenses (regular and recurring)
    public function getAllExpensesAttribute()
    {
    $expenses = $this->relationLoaded('expenses') 
        ? $this->expenses 
        : $this->expenses()->get();
        
    $recurringExpenses = $this->relationLoaded('recurringExpenses') 
        ? $this->recurringExpenses 
        : $this->recurringExpenses()->get();

    return $expenses->merge($recurringExpenses);
    }
}
