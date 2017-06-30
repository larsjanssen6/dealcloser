<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class SettingsProfileRequest extends FormRequest
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
            'name'          => 'max:50|nullable',
            'email'         => 'max:50|email|nullable',
            'phone'         => 'max:20|nullable',
            'website'       => 'max:50|url|nullable',
            'description'   => 'max:500|nullable',
        ];
    }
}
