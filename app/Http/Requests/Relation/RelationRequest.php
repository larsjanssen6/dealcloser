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
        $email = 'required|max:50|email|unique:relation,email';

        if ($this->method() == 'PATCH') {
            $email = 'required|max:50|email|unique:relation,email,'.$this->request->all()['id'];
        }

        return [
            'name'                      => 'required|max:50',
            'preposition'               => 'max:10',
            'last_name'                 => 'required|max:50',
            'initial'                   => 'max:10',
            'email'                     => $email,
            'linkedin'                  => 'max:50',
            'phone'                     => 'max:9223372036854775807|numeric|nullable',
            'gender'                    => 'required|integer|between:0,1',
            'country_code'              => 'required|max:3',
            'state_code'                => 'required|max:3',
            'function'                  => 'required|max:50',
            'date_of_birth'             => 'date_format:Y-m-d H:i|nullable',
            'employee_since'            => 'date_format:Y-m-d H:i|nullable',
            'role_id'                   => 'required|exists:relation_negotiation,id',
            'character_id'              => 'required|exists:relation_negotiation,id',
            'negotiation_profile_id'    => 'required|exists:relation_negotiation,id',
            'dmu_id'                    => 'required|exists:relation_negotiation,id',
            'problem_owner'             => 'required|boolean',
            'worked_at'                 => 'max:50',
            'hobbies'                   => 'max:50',
            'married'                   => 'required|boolean',
            'children'                  => 'required|boolean',
            'newsletter'                => 'required|boolean',
            'o3'                        => 'required|boolean',
            'events'                    => 'required|boolean',
            'send_email'                => 'required|boolean',
            'christmas_card'            => 'required|boolean',
            'experience_with_us'        => 'max:500',
            'track_record'              => 'max:500',
        ];
    }
}
