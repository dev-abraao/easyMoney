<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class UserPayment extends Model
{
    use HasUuids;

    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'description',
        'payment_amount',
        'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
