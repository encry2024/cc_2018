<?php

namespace App\Models\Supplier\Traits\Relationship;

use App\Models\Cart\Cart;
use App\Models\Item\Item;
use App\Models\Transaction\Transaction;

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
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function transactions()
    {
        return $this->hasMany(transaction::class);
    }
}
