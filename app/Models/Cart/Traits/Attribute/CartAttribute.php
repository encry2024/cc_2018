<?php

namespace App\Models\Cart\Traits\Attribute;

/**
 * Trait CartAttribute.
 */
trait CartAttribute
{
    /**
     * @return string
     */
    public function getUpdateButtonAttribute()
    {
        if ($this->status == "QUEUE")
            return 
                '<a href="'.route('admin.cart.update', $this).'"
                    class="btn btn-info btn-xs" 
                    data-method="patch"
                    data-trans-button-cancel="Cancel"
                    data-trans-button-confirm="Request"
                    data-trans-title="Request a restock for this item?">
                    <i class="fa fa-code-fork" data-toggle="tooltip" data-placement="top" title="Request"></i>
                </a>';
        elseif ($this->status == "REQUESTED") {
            return 
            '<a href="'.route('admin.cart.update', $this).'"
                class="btn btn-success btn-xs"
                data-method="patch"
                data-trans-button-cancel="Cancel"
                data-trans-button-confirm="Received"
                data-trans-title="Mark this item as received?">
                <i class="fa fa-check" data-toggle="tooltip" data-placement="top" title="Received"></i>
            </a>';
        } else {
            return '<label style="font-size: 10px;" class="badge badge-success">ORDER RECEIVED</label>';
        }
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group btn-group-sm" role="group" aria-label="Cart Actions">
            '.$this->update_button.'</div>';
    }
}
