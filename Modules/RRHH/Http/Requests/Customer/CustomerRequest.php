<?php

namespace Modules\RRHH\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
                    'name' => 'required',
                    'contact_firstname' => 'required',
                    'contact_lastname' => 'required',
                    'phone' => 'required',
                    'email' => 'required',
                ];
                break;

            case 'PUT':
            case 'PATCH':
                return [
                    'name' => 'required',
                    'contact_firstname' => 'required',
                    'contact_lastname' => 'required',
                    'phone' => 'required',
                    'email' => 'required',
                ];
                break;

            default:
                break;
        }
    }
}
