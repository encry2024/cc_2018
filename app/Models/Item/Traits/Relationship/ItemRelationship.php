<?php

namespace App\Models\Item\Traits\Relationship;

use App\Models\Cart\Cart;
use App\Models\Supplier\Supplier;
use App\Models\Transaction\Transaction;

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

    /**
     * @return mixed
     */
    public function transactions()
    {
        return $this->belongsToMany(Transaction::class);
    }

    /**
     * @return mixed
     */
    public function carts()
    {
        return $this->belongsToMany(Cart::class);
    }
}
