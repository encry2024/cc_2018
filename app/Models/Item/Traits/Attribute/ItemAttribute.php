<?php

namespace App\Models\Item\Traits\Attribute;

use Illuminate\Support\Facades\Route;
/**
* Trait ItemAttribute.
*/
trait ItemAttribute
{
   public function getStocksAttribute()
   {
     return $this->final_weight . ' ' . $this->final_weight_type;
   }

   /**
   * @return string
   */
   public function getRestockButtonAttribute()
   {
     return '<a href="'.route('admin.supplier.show', $this->supplier_id).'" class="btn btn-dark"><i class="fa fa-refresh" data-toggle="tooltip" data-placement="top" title="Re-stock"></i></a>';
   }

   public function getShowButtonAttribute()
   {
     return '<a href="'.route('admin.item.show', $this).'" class="btn btn-info"><i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.view').'"></i></a>';
   }

   /**
   * @return string
   */
   public function getEditButtonAttribute()
   {
     return '<a href="'.route('admin.item.edit', $this).'" class="btn btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.crud.edit').'"></i></a>';
   }

   /**
   * @return string
   */
   public function getDeleteButtonAttribute()
   {
     if ($this->id) {
         return '<a href="'.route('admin.item.destroy', $this).'"
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
     return '<a href="'.route('admin.item.delete-permanently', $this).'" name="confirm_item" class="btn btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Delete Permanently"></i></a> ';
   }

   /**
   * @return string
   */
   public function getRestoreButtonAttribute()
   {
     return '<a href="'.route('admin.item.restore', $this).'" name="confirm_item" class="btn btn-info"><i class="fa fa-refresh" data-toggle="tooltip" data-placement="top" title="Restore Item"></i></a> ';
   }

   /**
     * @return string
   */
   public function getOrderButtonAttribute()
   {
     return '<button class="btn btn-sm btn-success order_btn"
         title="Order Product"
         name="order_btn"
         data-toggle="modal"
         data-target="#order_item_modal"
         data-item-id="'.$this->id.'"
         data-item-name="'.$this->name.'"
         data-item-selling_price="'.$this->selling_price.'"
         data-item-initial_weight_type="'.$this->initial_weight_type.'">
         <i class="fa fa-cart-plus"></i></button>';
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

     if(Route::currentRouteName('admin.item*')) {
         return '
         <div class="btn-group btn-group-sm" role="group" aria-label="Item Actions">
         '.$this->restock_button.'
         '.$this->show_button.'
         '.$this->edit_button.'
         '.$this->delete_button.'
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
