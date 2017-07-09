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
        if ($this->method() == 'PATCH') {
            $organisation = 'required|max:50|required|unique:relation,organisation,' . $this->request->all()['id'];
            $email = 'required|max:50|email|unique:relation,email,' . $this->request->all()['id'];
        }

        else {
            $organisation = 'required|max:50|required|unique:relation,organisation';
            $email = 'required|max:50|email|unique:relation,email';
        }

        return [
            'category_id'       => 'required|integer|exists:category,id',
            'account_manager'   => 'required|max:50|required',
            'organisation'      => $organisation,
            'country_code'      => 'required|max:3|required',
            'state_code'        => 'required|max:3|required',
            'street'            => 'required|max:30|required',
            'house_number'      => 'required|integer',
            'sales_area'        => 'required|max:50|required',
            'zip'               => 'required|max:10|required',
            'town'              => 'required|max:50|required',
            'phone'             => 'required|max:50|required',
            'email'             => $email,
            'facebook'          => 'max:50|nullable',
            'whatsapp'          => 'max:50|nullable',
            'website'           => 'max:50|nullable'
        ];
    }
}
