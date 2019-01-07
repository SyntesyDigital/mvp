<?php

namespace Modules\RRHH\Http\Requests\Admin\CustomersUsers;

use Illuminate\Foundation\Http\FormRequest;

class CreateCustomerUserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => 'required|unique:users|email',
            'firstname' => 'required',
            'lastname' => 'required',
            'password' => 'required|confirmed',
        ];
    }


    public function authorize()
    {
        return true;
    }
}
