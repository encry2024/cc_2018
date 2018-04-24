<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Customer\Traits\Attribute\CustomerAttribute;
use App\Models\Customer\Traits\Relationship\CustomerRelationship;

class Customer extends Model
{
    // Traits
    use SoftDeletes,
        CustomerAttribute,
        CustomerRelationship;

    protected $fillable = ['name', 'email', 'contact_number', 'address', 'discount', 'credit_limit'];

    protected $dates = ['deleted_at'];

    protected $appends = ['current_credit', 'progress_credit', 'usable_credit'];
}
