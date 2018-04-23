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
        'amount_paid',
        'date_paid'
    ];
}
