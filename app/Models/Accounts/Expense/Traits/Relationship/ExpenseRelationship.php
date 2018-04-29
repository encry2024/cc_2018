<?php

namespace App\Models\Accounts\Expense\Traits\Relationship;

use App\Models\Cashflow\Cashflow;
use App\Models\Auth\User;

trait ExpenseRelationship
{
    public function cashflow()
    {
        return $this->morphMany(Cashflow::class, 'cashflowable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}