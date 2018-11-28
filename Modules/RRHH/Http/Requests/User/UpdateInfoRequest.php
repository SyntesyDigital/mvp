<?php

namespace Modules\RRHH\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInfoRequest extends FormRequest
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
            'email' => 'email|required',
            'city' => 'max:40',
            'telephone' => 'max:191',
            'postal_code' => 'max:10',
            'address' => 'max:150',
        ];
    }
}
