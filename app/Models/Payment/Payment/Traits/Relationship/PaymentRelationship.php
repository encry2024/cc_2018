<?php

namespace App\Models\Payment\Payment\Traits\Relationship;

use App\Models\Payment\Cash\Cash;
use App\Models\Payment\Check\Check;
use App\Models\Cashflow\Cashflow;

trait PaymentRelationship
{
    public function paymentable()
    {
        return $this->morphTo();
    }

    public function cashflow()
    {
        return $this->morphMany(Cashflow::class, 'cashflowable');
    }
}