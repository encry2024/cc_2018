<?php

namespace App\Events\Backend\Supplier;

use Illuminate\Queue\SerializesModels;

/**
 * Class SupplierUpdated.
 */
class SupplierUpdated
{
    use SerializesModels;

    /**
     * @var
     */
    public $supplier;

    /**
     * @param $supplier
     */
    public function __construct($supplier)
    {
        $this->supplier = $supplier;
    }
}
