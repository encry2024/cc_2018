<?php

namespace App\Models\Accounts\Payable\Traits\Relationship;

use App\Models\Accounts\Receivable\Receivable;

trait PayableRelationship
{
    public function payable()
    {
        return $this->morphTo();
    }
}