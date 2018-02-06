<?php

namespace App\Models\Item\Traits\Relationship;

use App\Models\Supplier\Supplier;

/**
 * Trait ItemRelationship.
 */
trait ItemRelationship
{
    /**
     * @return mixed
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
