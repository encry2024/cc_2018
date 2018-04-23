<?php

namespace App\Models\Payment\Payment;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Payment\Payment\Traits\Relationship\PaymentRelationship;

class Payment extends Model
{
    // Traits
    use SoftDeletes,
        PaymentRelationship;

    protected $fillable = [
        'user_id',
        'order_id',
        'paymentable_id',
        'paymentable_type'
    ];
}
