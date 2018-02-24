<?php

namespace App\Events\Backend\Transaction;

use Illuminate\Queue\SerializesModels;

/**
 * Class TransactionRestored.
 */
class TransactionRestored
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
