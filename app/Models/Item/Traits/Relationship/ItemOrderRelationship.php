<?php

namespace App\Models\Item\Traits\Relationship;

use App\Models\Supplier\Supplier;
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
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
