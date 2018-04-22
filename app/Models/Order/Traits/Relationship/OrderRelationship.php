<?php

namespace App\Models\Order\Traits\Relationship;

use App\Models\Order\Order;
use App\Models\Item\Item;
use App\Models\ItemOrder\ItemOrder;
use App\Models\Customer\Customer;
use App\Models\Auth\User;

trait OrderRelationship
{
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function item_orders()
    {
        return $this->hasMany(ItemOrder::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}