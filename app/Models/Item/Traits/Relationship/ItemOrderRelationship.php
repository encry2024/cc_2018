<?php

namespace App\Models\Item\Traits\Relationship;

use App\Models\Order\Order;
use App\Models\Item\Item;

/**
 * Trait ItemOrderRelationship.
 */
trait ItemOrderRelationship
{
    /**
     * @return mixed
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    /**
     * @return mixed
     */
    public function order()
    {
        return $this->belongsToMany(Order::class);
    }
}
