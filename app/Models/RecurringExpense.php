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
        'frequency',
        'next_due_date',
    ];
}
