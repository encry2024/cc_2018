<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction\Traits\Relationship\ItemTransactionRelationship;

class ItemTransaction extends Model
{
    use ItemTransactionRelationship;

    // Fillable fields
    protected $fillable = [
        'transaction_id', 'item_id', 'quantity', 'total_price'
    ];

    protected $table = 'item_transaction';
}
