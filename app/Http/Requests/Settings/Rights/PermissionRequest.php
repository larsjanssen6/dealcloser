<?php

namespace App\Http\Requests\Settings\Rights;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
            'role'          => 'integer|required|exists:roles,id',
            'permission'    => 'required|exists:permissions,name',
        ];
    }
}