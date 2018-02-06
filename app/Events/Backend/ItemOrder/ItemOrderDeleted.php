<?php

namespace App\Events\Backend\ItemOrder;

use Illuminate\Queue\SerializesModels;

/**
 * Class ItemOrderDeleted.
 */
class ItemOrderDeleted
{
    use SerializesModels;

    /**
     * @var
     */
    public $item_order;

    /**
     * @param $item_order
     */
    public function __construct($item_order)
    {
        $this->item_order = $item_order;
    }
}
