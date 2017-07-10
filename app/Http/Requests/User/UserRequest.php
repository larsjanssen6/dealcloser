<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name'          => 'required|max:50|required',
            'last_name'     => 'required|max:50|required',
            'email'         => 'required|max:50|email|unique:user,email,'.$this->request->all()['id'],
            'function'      => 'required|max:50|nullable',
            'department_id' => 'required|integer|exists:department,id',
            'active'        => 'required|integer|between:0,1',
            'role'          => 'required|exists:roles,name',
        ];

        if (isset($this->request->all()['password'])) {
            $rules += ['password' => 'min:5|max:30|confirmed'];
        }

        return $rules;
    }
}
