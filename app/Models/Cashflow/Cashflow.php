<?php

namespace App\Models\Cashflow;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cashflow\Traits\Relationship\CashflowRelationship;
use App\Models\Cashflow\Traits\Attribute\CashflowAttribute;
use App\Models\Cashflow\Traits\Scope\CashflowScope;

class Cashflow extends Model
{
    //
    use CashflowScope,
        CashflowAttribute,
        CashflowRelationship;

    protected $fillable = [
        'amount',
        'cashflowable_id',
        'cashflowable_type'
    ];

    protected $append = ['type', 'receivable'];
}
