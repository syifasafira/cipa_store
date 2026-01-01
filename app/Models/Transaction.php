<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'code',
        'total_price',
        'shipping_status',
        'payment_status',
        'courier',
        'shipping_cost',
        'tracking_number',
    ];
    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
