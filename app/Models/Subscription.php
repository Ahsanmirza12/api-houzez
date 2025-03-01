<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Cashier\Subscription as CashierSubscriptions;

class Subscription extends CashierSubscriptions
{
    protected $fillable = [
        'user_id',
        'type',
        'stripe_id',
        'stripe_status', 
        'stripe_price',
        'quantity',
        'trial_ends_at',
        'ends_at'

    ];
    public function user() :BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function plan() :BelongsTo
    {
        return $this->belongsTo(Plan::class,'stripe_price','plan_id');
    }
}
