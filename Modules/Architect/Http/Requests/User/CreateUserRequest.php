<?php

namespace Modules\Architect\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'firstname',
            'lastname',
            'email',
            'password',
            'image',
        ];
    }


    public function authorize()
    {
        return true;
    }
}
