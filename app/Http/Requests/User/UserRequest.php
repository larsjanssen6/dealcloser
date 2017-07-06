<?php

namespace App\Http\Requests\User;

use Illuminate\Support\Facades\Auth;
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
        $rules =  [
            'name'          => 'min:3|max:50|required',
            'last_name'     => 'min:3|max:50|required',
            'email'         => 'min:5|max:50|email|unique:user,email,' . $this->request->all()['id'],
            'function'      => 'min:3|max:50|nullable',
            'department_id' => 'integer|required|exists:department,id',
            'active'        => 'integer|required|between:0,1',
            'role'          => 'required|exists:roles,name'
        ];

        if(isset($this->request->all()['password']))
        {
            $rules += ['password' => 'min:5|max:30|confirmed'];
        }

        return $rules;
    }
}
