<?php

namespace App\Models\Payment\Payment\Traits\Relationship;

use App\Models\Payment\Cash\Cash;
use App\Models\Payment\Check\Check;

trait PaymentRelationship
{
    public function paymentable()
    {
        return $this->morphTo();
    }
}