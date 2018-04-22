<?php

namespace App\Models\Customer\Traits\Relationship;

use App\Models\Customer\Customer;
use App\Models\Order\Order;

trait CustomerRelationship
{
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}