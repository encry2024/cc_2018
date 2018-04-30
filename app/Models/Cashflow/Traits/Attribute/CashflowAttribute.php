<?php

namespace App\Models\Cashflow\Traits\Attribute;

trait CashflowAttribute
{
    public function getTypeAttribute()
    {
        return class_basename($this->cashflowable_type);
    }


}