<?php

namespace App\Http\Requests\Settings\Usage;

use Illuminate\Foundation\Http\FormRequest;

class UsageRequest extends FormRequest
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
            'users'          => 'max:2147483647|integer|nullable',
            'active'         => 'max:50|date|nullable',
            'license'        => 'max:50|nullable',
        ];
    }
}
