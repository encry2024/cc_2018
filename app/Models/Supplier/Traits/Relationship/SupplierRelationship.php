<?php

namespace App\Models\Supplier\Traits\Relationship;

use App\Models\Item\Item;
use App\Models\Item\ItemOrder;

/**
 * Trait SupplierRelationship.
 */
trait SupplierRelationship
{
    /**
     * @return mixed
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    /**
     * @return mixed
     */
    public function item_orders()
    {
        return $this->hasMany(ItemOrder::class);
    }
}
