<?php

namespace Modules\Architect\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => 'email|required',
            'firstname' => 'required',
            'lastname' => 'required',
            //'password' => request()->get('password') ? 'required|confirmed' : null
            'role_id' => 'required',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
