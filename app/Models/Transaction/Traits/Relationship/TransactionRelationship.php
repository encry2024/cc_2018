<?php

namespace App\Models\Transaction\Traits\Relationship;

use App\Models\Item\Item;
use App\Models\Auth\User;
use App\Models\Transaction\ItemTransaction;

/**
 * Trait TransactionRelationship.
 */
trait TransactionRelationship
{
    /**
     * @return mixed
     */
    public function items()
    {
        return $this->belongsToMany(Item::class);
    }

    /**
     * @return mixed
     */
    public function item_transactions()
    {
        return $this->hasMany(ItemTransaction::class);
    }

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
