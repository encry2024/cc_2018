<?php

namespace App\Models\Payment\Cash\Traits\Relationship;

use App\Models\Payment\Payment\Payment;
use App\Models\Auth\User;

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
}