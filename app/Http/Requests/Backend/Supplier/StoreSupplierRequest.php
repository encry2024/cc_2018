<?php

namespace App\Http\Requests\Backend\Supplier;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSupplierRequest extends FormRequest
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
            'name'                         => 'required|max:191',
            'contact_person_first_name'    => 'required|max:191',
            'contact_person_last_name'     => 'required|max:191',
            'email'                        => ['required', 'email', 'max:191', Rule::unique('suppliers')],
            'address'                      => 'required|max:191',
            'mobile_number'                => 'required|max:11'
        ];
    }
}
