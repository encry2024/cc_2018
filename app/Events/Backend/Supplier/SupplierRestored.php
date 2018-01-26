<?php
/**
 * Created by PhpStorm.
 * User: christanjake2024
 * Date: 1/25/18
 * Time: 11:54 AM
 */
namespace App\Events\Backend\Supplier;

use Illuminate\Queue\SerializesModels;

/**
 * Class SupplierRestored.
 */
class SupplierRestored
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
