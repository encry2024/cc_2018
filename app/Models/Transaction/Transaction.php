<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction\Traits\Attribute\TransactionAttribute;
use App\Models\Transaction\Traits\Relationship\TransactionRelationship;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    // Traits
    use TransactionAttribute,
        TransactionRelationship,
        SoftDeletes;

    // Fillable Columns
    protected $fillable = [
        'user_id',
        'status'
    ];

    // Soft Delete
    protected $dates = ['deleted_at'];
}
