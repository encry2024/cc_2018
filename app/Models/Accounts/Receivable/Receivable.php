<?php

namespace App\Models\Accounts\Receivable;

use Illuminate\Database\Eloquent\Model;
use App\Models\Accounts\Receivable\Traits\Relationship\ReceivableRelationship;

class Receivable extends Model
{
    //
    use ReceivableRelationship;

    protected $fillable = [
        'amount',
        'receivable_id',
        'receivable_type'
    ];
}
