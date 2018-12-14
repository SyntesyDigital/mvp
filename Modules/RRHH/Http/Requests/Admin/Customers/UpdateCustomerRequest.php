<?php

namespace Modules\RRHH\Http\Requests\Admin\Customers;

use Config;
use Illuminate\Foundation\Http\FormRequest;

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
        return Config::get('customers.rules');
    }

    public function messages()
    {
        return Config::get('customers.messages');
    }
}
