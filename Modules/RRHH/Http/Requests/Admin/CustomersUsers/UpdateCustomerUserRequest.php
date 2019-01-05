<?php

namespace Modules\RRHH\Http\Requests\Admin\CustomersUsers;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerUserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => 'required|email|unique:users,email,'. $this->get('id'),
            'firstname' => 'required',
            'lastname' => 'required',
        ];
    }


    public function authorize()
    {
        return true;
    }
}
