<?php

namespace App\Models\Payment\Check;

use Illuminate\Database\Eloquent\Model;
use App\Models\Payment\Check\Traits\Relationship\CheckRelationship;
use Illuminate\Database\Eloquent\SoftDeletes;

class Check extends Model
{
    //
    use SoftDeletes,
        CheckRelationship;

    protected $fillable = [
        'payment_id',
        'account_number',
        'bank',
        'amount_paid',
        'date_of_claim',
        'type'
    ];
}
