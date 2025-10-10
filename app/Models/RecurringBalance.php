<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class RecurringBalance extends Model
{
    use HasUuids;

    protected $keyType = 'string';
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'amount',
        'frequency',
        'next_due_date',
    ];
}
