<?php

namespace App\Models\Cashflow;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cashflow\Traits\Relationship\CashflowRelationship;

class Cashflow extends Model
{
    //
    use CashflowRelationship;

    protected $fillable = [
        'amount',
        'cashflowable_id',
        'cashflowable_type'
    ];
}
