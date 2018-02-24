<?php

namespace App\Models\Cart\Traits\Relationship;

use App\Models\Supplier\Supplier;
use App\Models\Item\Item;

/**
 * Trait CartRelationship.
 */
trait CartRelationship
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
