<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
class UserBalance extends Model
{
    use HasUuids;
    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'balance_amount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
