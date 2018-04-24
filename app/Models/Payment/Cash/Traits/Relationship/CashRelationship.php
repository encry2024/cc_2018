<?php

namespace App\Models\Payment\Cash\Traits\Relationship;

use App\Models\Payment\Payment\Payment;

trait CashRelationship
{
    public function payment()
    {
        return $this->morphMany(Payment::class, 'paymentable');
    }
}