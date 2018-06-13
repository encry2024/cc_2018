<?php

namespace App\Models\Accounts\Receivable\Traits\Relationship;

use App\Models\Cashflow\Cashflow;

trait ReceivableRelationship
{
    public function receivable()
    {
        return $this->morphTo();
    }

    public function cashflows()
    {
        return $this->morphMany(Cashflow::class, 'cashflowable');
    }
}