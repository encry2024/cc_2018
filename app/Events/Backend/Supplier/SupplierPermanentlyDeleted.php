<?php
/**
 * Created by PhpStorm.
 * User: christanjake2024
 * Date: 1/25/18
 * Time: 11:53 AM
 */
namespace App\Events\Backend\Supplier;

use Illuminate\Queue\SerializesModels;

/**
 * Class SupplierPermanentlyDeleted.
 */
class SupplierPermanentlyDeleted
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
