<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Order\Traits\Relationship\OrderRelationship;
use App\Models\Order\Traits\Attribute\OrderAttribute;

class Order extends Model
{
    use SoftDeletes,
        OrderRelationship,
        OrderAttribute;
    //
    protected $fillable = [
        'user_id',
        'status',
        'balance',
        'collection_date',
        'payment_type',
        'note'
    ];

    protected $appends = ['payment_method', 'due_date', 'remaining_balance'];
}
