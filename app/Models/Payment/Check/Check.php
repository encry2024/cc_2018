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
        'user_id',
        'order_id',
        'account_number',
        'bank',
        'date_of_claim',
        'type',
        'status'
    ];
}
