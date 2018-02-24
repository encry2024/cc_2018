<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Customer\Traits\Attribute\CustomerAttribute;

class Customer extends Model
{
    use CustomerAttribute, SoftDeletes;

    protected $fillable = ['name', 'email', 'contact_number', 'address', 'discount', 'credit_limit'];

    protected $dates = ['deleted_at'];
}
