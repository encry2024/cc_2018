<?php

namespace App\Models\Accounts\Payable;

use Illuminate\Database\Eloquent\Model;
use App\Models\Accounts\Payable\Traits\Relationship\PayableRelationship;

class Payable extends Model
{
    //
    use PayableRelationship;

    protected $fillable = [
        'amount',
        'payable_id',
        'payable_type'
    ];
}
