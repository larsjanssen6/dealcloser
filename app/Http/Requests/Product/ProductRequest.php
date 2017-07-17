<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => 'required|max:50',
            'description'   => 'required|max:255',
            'price'         => 'required|max:8|regex:/^\d*(\.\d{1,2})?$/',
            'purchase'      => 'required|max:8|regex:/^\d*(\.\d{1,2})?$/',
            'amount'        => 'required|max:2147483647|integer',
        ];
    }
}
