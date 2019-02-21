<?php

namespace Modules\Extranet\Http\Requests\User;

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
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':

                return [];

            case 'POST':

                return [
                    'firstname' => 'required',
                    'lastname' => 'required',
                    'email' => 'required|email',
                    'password' => 'required',
                ];

            case 'PUT':
            case 'PATCH':

                return [
                    'firstname' => 'required',
                    'lastname' => 'required',
                    'email' => 'required|email',
                ];

            default:break;
        }
    }
}
