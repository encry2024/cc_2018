<?php

namespace App\Models\Cart;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cart\Traits\Relationship\CartRelationship;

class Cart extends Model
{
    use CartRelationship;
    //
    protected $fillable = ['supplier_id', 'item_id', 'total_price', 'quantity', 'status'];
}
