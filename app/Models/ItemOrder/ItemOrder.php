<?php

namespace App\Models\ItemOrder;

use Illuminate\Database\Eloquent\Model;
use App\Models\Item\Traits\Relationship\ItemOrderRelationship;
use App\Models\Item\Traits\Attribute\ItemOrderAttribute;

class ItemOrder extends Model
{
    use ItemOrderAttribute,
        ItemOrderRelationship;

    protected $table = 'item_order';
    //
    protected $fillable = ['item_id', 'total_cost', 'requested_quantity', 'delivery_date'];

    protected $appends = ['ordered_quantity'];
}
