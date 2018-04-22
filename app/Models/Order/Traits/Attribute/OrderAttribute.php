<?php

namespace App\Models\Order\Traits\Attribute;

trait OrderAttribute
{
    /**
     * Get formatted payment method
     */
    public function getPaymentMethodAttribute()
    {
        return $this->payment_type == "cod" ? "Cash On Delivery" : $this->payment_type;
    }

    /**
     * Get due date of the order
     */
    public function getDueDateAttribute()
    {
        if ($this->payment_type != "cod") {
            $payment_method = explode(" ", $this->payment_type);
            $days = $payment_method[0];

            $due_date = date("Y-m-d", strtotime($this->created_at." +".$days." days"));

            return date("F d, Y", strtotime($due_date));
        }

        return $this->payment_method;
    }

    /**
     * Get formatted balance
     */
    public function getRemainingBalanceAttribute()
    {
        return "PHP " . number_format($this->balance, 2);
    }

    public function getShowButtonAttribute()
    {
        return '<a href="'.route('admin.order.show', $this).'" class="btn btn-info"><i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.view').'"></i></a>';
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        return '<a href="'.route('admin.order.edit', $this).'" class="btn btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.edit').'"></i></a>';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        if ($this->id) {
            return '<a href="'.route('admin.order.destroy', $this).'"
                data-method="delete"
                data-trans-button-cancel="'.__('buttons.general.cancel').'"
                data-trans-button-confirm="'.__('buttons.general.crud.delete').'"
                data-trans-title="'.__('strings.backend.general.are_you_sure').'"
                class="btn btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.delete').'"></i></a> ';
        }
    }

    /**
     * @return string
    */
    public function getDeletePermanentlyButtonAttribute()
    {
        return '<a href="'.route('admin.order.delete-permanently', $this).'" name="confirm_item" class="btn btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Delete Permanently"></i></a> ';
    }

    /**
     * @return string
    */
    public function getRestoreButtonAttribute()
    {
        return '<a href="'.route('admin.order.restore', $this).'" name="confirm_item" class="btn btn-info"><i class="fa fa-refresh" data-toggle="tooltip" data-placement="top" title="Restore Item"></i></a> ';
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        if ($this->trashed()) {
            return '
                <div class="btn-group btn-group-sm" role="group" aria-label="Item Actions">
                '.$this->restore_button.'
                '.$this->delete_permanently_button.'
                </div>';
        }

        return '
            <div class="btn-group btn-group-sm" role="group" aria-label="Item Actions">
            '.$this->show_button.'
            '.$this->edit_button.'
            '.$this->delete_button.'
            </div>';
    }
}