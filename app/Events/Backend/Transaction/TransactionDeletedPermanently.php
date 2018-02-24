<?php

namespace App\Events\Backend\Transaction;

use Illuminate\Queue\SerializesModels;

/**
 * Class TransactionDeletedPermanently.
 */
class TransactionDeletedPermanently
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
