<?php

namespace App\Models\Payment\Cash;

use Illuminate\Database\Eloquent\Model;
use App\Models\Payment\Cash\Traits\Relationship\CashRelationship;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cash extends Model
{
    //
    use SoftDeletes,
        CashRelationship;

    protected $fillable = [
        'payment_id',
        'user_id',
        'order_id',
        'date_paid'
    ];
}
