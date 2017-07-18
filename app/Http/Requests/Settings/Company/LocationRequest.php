<?php

namespace App\Http\Requests\settings\Company;

use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
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
            'address'   => 'max:30|nullable',
            'zip'       => 'max:10|nullable',
            'town'      => 'max:30|nullable',
        ];
    }
}
