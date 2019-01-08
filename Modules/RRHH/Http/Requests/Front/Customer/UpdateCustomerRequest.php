<?php

namespace Modules\RRHH\Http\Requests\Front\Customer;

use Config;
use Illuminate\Foundation\Http\FormRequest;

use Auth;

class UpdateCustomerRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email',
            'firstname' => 'required',
            'lastname' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'postcode' => 'required',
            'city' => 'required',

            'user_firstname' => 'required',
            'user_lastname' => 'required',
            'user_telephone' => 'required',
            'user_email' => 'required|email|unique:users,email,'.Auth::user()->id,
            'password' => 'sometimes|nullable|min:6|confirmed',

        ];
    }

}
