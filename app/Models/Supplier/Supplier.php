<?php

namespace App\Models\Supplier;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Supplier\Traits\Attribute\SupplierAttribute;
use App\Models\Supplier\Traits\Relationship\SupplierRelationship;

class Supplier extends Model
{
    use SupplierAttribute,
        SupplierRelationship,
        SoftDeletes;
    //

    protected $fillable = [
        'name',
        'contact_person_first_name',
        'contact_person_last_name',
        'email',
        'mobile_number',
        'telephone_number',
        'address'
    ];

    protected $appends = ['full_name'];
}
