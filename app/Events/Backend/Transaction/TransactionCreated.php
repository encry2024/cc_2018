<?php

namespace App\Events\Backend\Transaction;

use Illuminate\Queue\SerializesModels;

/**
 * Class TransactionCreated.
 */
class TransactionCreated
{
    use SerializesModels;

    /**
     * @var
     */
    public $transaction;

    /**
     * @param $transaction
     */
    public function __construct($transaction)
    {
        $this->transaction = $transaction;
    }
}
