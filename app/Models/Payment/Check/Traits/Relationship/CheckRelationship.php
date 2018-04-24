<?php

namespace App\Models\Payment\Check\Traits\Relationship;

use App\Models\Payment\Payment\Payment;

trait CheckRelationship
{
    public function payment()
    {
        return $this->morphMany(Payment::class, 'paymentable');
    }
}