<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class RecurringExpense extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'rec_ex_amount',
        'card_id',
        'frequency',
        'next_due_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function card()
    {
        return $this->belongsTo(Card::class);
    }
}
