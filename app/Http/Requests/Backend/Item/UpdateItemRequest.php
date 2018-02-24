<?php

namespace App\Http\Requests\Backend\Item;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
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
            'supplier'                     => 'required',
            'selling_price'                => 'required|max:13',
            'initial_weight'               => 'required|max:13',
            'final_weight'                 => 'required|max:191'
        ];
    }
}
