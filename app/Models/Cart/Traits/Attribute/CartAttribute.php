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
                    class="btn btn-info btn-xs text-white"
                    data-method="patch"
                    data-trans-button-cancel="Cancel"
                    data-trans-button-confirm="Request"
                    data-trans-title="Request a restock for this item?">
                    <i class="fa fa-refresh" data-toggle="tooltip" data-placement="top" title="Request"></i>
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
    public function getDeleteButtonAttribute()
    {
        if ($this->status == "QUEUE") {
            return
                '<a href="'.route('admin.cart.destroy', $this).'"
                    class="btn btn-danger btn-xs text-white"
                    data-method="delete"
                    data-trans-button-cancel="No"
                    data-trans-button-confirm="Yes"
                    data-trans-title="Are you sure you want to cancel this request?">
                    <i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Cancel Request"></i>
                </a>';
        }
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        return '<div class="btn-group btn-group-sm" role="group" aria-label="Cart Actions">
            '.$this->update_button.'
            '.$this->delete_button.'
            </div>';
    }
}
