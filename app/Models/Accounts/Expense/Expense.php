<?php

namespace App\Models\Accounts\Expense;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Accounts\Expense\Traits\Relationship\ExpenseRelationship;
use App\Models\Accounts\Expense\Traits\Attribute\ExpenseAttribute;

class Expense extends Model
{
    //
    use SoftDeletes,
        ExpenseAttribute,
        ExpenseRelationship;

    protected $fillable = [
        'code',
        'amount',
        'user_id',
        'requested_by',
        'cause'
    ];
}
