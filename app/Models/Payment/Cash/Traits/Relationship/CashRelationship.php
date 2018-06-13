<?php

namespace App\Models\Payment\Cash\Traits\Relationship;

use App\Models\Payment\Payment\Payment;
use App\Models\Auth\User;
use App\Models\Order\Order;

trait CashRelationship
{
    public function payment()
    {
        return $this->morphMany(Payment::class, 'paymentable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}