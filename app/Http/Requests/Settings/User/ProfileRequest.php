<?php

namespace App\Http\Requests\Settings\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
        $rules = [
            'name'          => 'min:3|max:50|required',
            'preposition'   => 'max:10|nullable',
            'last_name'     => 'min:3|max:50|required',
            'email'         => 'min:5|max:50|email|unique:user,email,'.Auth::user()->id,
            'function'      => 'min:3|max:50|nullable',
            'department_id' => 'integer|required|exists:department,id',

        ];

        if (isset($this->request->all()['password'])) {
            $rules += ['password' => 'min:5|max:30|confirmed'];
        }

        return $rules;
    }
}
