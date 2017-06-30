<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name'      => 'min:3|max:50|required',
            'last_name' => 'min:3|max:50|required',
            'email'     => 'min:5|max:50|email|unique:users',
            'function'  => 'min:3|max:20|nullable',
            'role'      => 'required|exists:roles,name'
        ];
    }
}
