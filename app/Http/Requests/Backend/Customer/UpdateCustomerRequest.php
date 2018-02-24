<?php

namespace App\Http\Requests\Backend\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'              => 'required|max:60',
            'email'             => ['required', 'email', Rule::unique('customers', 'id')],
            'contact_number'    => 'required|max:191',
            'address'           => 'required',
            'discount'          => 'required',
            'credit_limit'      => 'required'
        ];
    }
}
