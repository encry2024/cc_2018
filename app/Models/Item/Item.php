<?php

namespace App\Models\Item;

use Illuminate\Database\Eloquent\Model;
use App\Models\Item\Traits\Attribute\ItemAttribute;
use App\Models\Item\Traits\Relationship\ItemRelationship;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    //
    use ItemAttribute,
        ItemRelationship,
        SoftDeletes;

    protected $fillable = [
        'supplier_id',
        'name',
        'selling_price',
        'buying_price',
        'initial_weight',
        'initial_weight_type',
        'final_weight',
        'final_weight_type'
    ];

    protected $dates = ['deleted_at'];
}
