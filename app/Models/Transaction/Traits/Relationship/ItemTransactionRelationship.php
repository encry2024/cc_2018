<?php

namespace App\Models\Transaction\Traits\Relationship;

use App\Models\Item\Item;
use App\Models\Transaction\Transaction;

/**
 * Trait ItemTransactionRelationship.
 */
trait ItemTransactionRelationship
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
