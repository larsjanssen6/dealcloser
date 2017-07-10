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
            'name'          => 'required|max:50|required',
            'last_name'     => 'required|max:50|required',
            'email'         => 'required|max:50|email|unique:user',
            'function'      => 'required|max:50|nullable',
            'role'          => 'required|exists:roles,name',
            'department_id' => 'required|integer|exists:department,id',
        ];
    }
}
