<?php

namespace App\Models\Accounts\Receivable\Traits\Relationship;

trait ReceivableRelationship
{
    public function receivable()
    {
        return $this->morphTo();
    }
}