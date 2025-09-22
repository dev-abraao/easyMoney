<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExpense extends Model
{
    use HasUuids;

    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'expense_type_id',
        'description',
        'amount',
        'card_id',
        'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
