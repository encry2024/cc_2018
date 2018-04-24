<?php

namespace App\Models\Payment\Check\Traits\Relationship;

use App\Models\Payment\Payment\Payment;
use App\Models\Auth\User;

trait CheckRelationship
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