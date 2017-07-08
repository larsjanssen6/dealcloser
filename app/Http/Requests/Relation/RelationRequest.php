<?php

namespace App\Http\Requests\Relation;

use Illuminate\Foundation\Http\FormRequest;

class RelationRequest extends FormRequest
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
            'category_id'       => 'required|integer|exists:category,id',
            'account_manager'   => 'required|max:50|required',
            'organisation'      => 'required|max:50|required|unique:relation',
            'country_code'      => 'required|max:3|required',
            'state_code'        => 'required|max:3|required',
            'street'            => 'required|max:30|required',
            'house_number'      => 'required|integer',
            'sales_area'        => 'required|max:50|required',
            'zip'               => 'required|max:10|required',
            'town'              => 'required|max:50|required',
            'phone'             => 'required|max:20|required',
            'email'             => 'required|max:50|email|unique:relation,email',
            'facebook'          => 'max:50|nullable',
            'whatsapp'          => 'max:50|nullable',
            'website'           => 'max:50|nullable'
        ];
    }
}
