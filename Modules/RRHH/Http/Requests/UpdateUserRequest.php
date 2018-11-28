<?php

namespace Modules\RRHH\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'role_id' => 'required',
            'city' => 'max:40',
            'postal_code' => 'max:10|required_with:address',
            'address' => 'min:10|max:150',
        ];
    }
}
