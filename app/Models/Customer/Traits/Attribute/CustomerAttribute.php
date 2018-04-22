<?php

namespace App\Models\Customer\Traits\Attribute;

/**
 * Trait CustomerAttribute.
 */
trait CustomerAttribute
{
    /**
     * Displays overall credit from all unpaid order of the customer
     *
     * @return string $current_credit
     */
    public function getCurrentCreditAttribute()
    {
        $current_credit = 0;

        foreach ($this->orders->where('status', 'PENDING') as $order) {
            $current_credit += $order->balance;
        }

        return "PHP " . number_format($current_credit, 2);
    }

    /**
     * Displays the percentage of the credit used
     *
     * @return double $current_credit
     */
    public function getProgressCreditAttribute()
    {
        $current_credit = 0;

        foreach ($this->orders->where('status', 'PENDING') as $order) {
            $current_credit += $order->balance;
        }

        $current_credit = $current_credit / $this->credit_limit;
        $current_credit = $current_credit * 100;

        return $current_credit;
    }

    /**
     * @return string
     */
    public function getShowButtonAttribute()
    {
        return '<a href="'.route('admin.customer.show', $this).'" class="btn btn-info"><i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.view').'"></i></a>';
    }

    /**
     * @return string
     */
    public function getOrderButtonAttribute()
    {
        $current_credit = explode('PHP ', $this->current_credit);
        $current_credit = $current_credit[1];
        $current_credit = str_replace(",", "", $current_credit);

        return
            '<a href="'.route('admin.customer.order', $this).'"
            name="order_btn"
            class="btn btn-success"
            data-toggle="tooltip"
            data-placement="top"
            data-credit_limit="'.$this->credit_limit.'"
            data-current_credit="'.$current_credit.'"
            title="Make an Order">
                <i class="fa fa-truck" data-toggle="tooltip" data-placement="top"></i>
            </a>';
    }

    /**
     * @return string
     */
    public function getEditButtonAttribute()
    {
        return '<a href="'.route('admin.customer.edit', $this).'" class="btn btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.edit').'"></i></a>';
    }

    /**
     * @return string
     */
    public function getDeleteButtonAttribute()
    {
        if ($this->id) {
            return
                '<a href="'.route('admin.customer.destroy', $this).'"
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
        return '<a href="'.route('admin.customer.delete-permanently', $this).'" name="confirm_item" class="btn btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Delete Permanently"></i></a> ';
    }

    /**
     * @return string
     */
    public function getRestoreButtonAttribute()
    {
        return '<a href="'.route('admin.customer.restore', $this).'" name="confirm_item" class="btn btn-info"><i class="fa fa-refresh" data-toggle="tooltip" data-placement="top" title="Restore Customer"></i></a> ';
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        if ($this->trashed()) {
            return '
				<div class="btn-group btn-group-sm" role="group" aria-label="Customer Actions">
				  '.$this->restore_button.'
				  '.$this->delete_permanently_button.'
				</div>';
        }

        return '
            <div class="btn-group btn-group-sm" role="group" aria-label="Customer Actions">
            '.$this->order_button.'
            '.$this->show_button.'
            '.$this->edit_button.'
            '.$this->delete_button.'
            </div>';
    }
}
