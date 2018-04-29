<?php

namespace App\Models\Cashflow\Traits\Relationship;

trait CashflowRelationship
{
    public function cashflowable()
    {
        return $this->morphTo();
    }
}