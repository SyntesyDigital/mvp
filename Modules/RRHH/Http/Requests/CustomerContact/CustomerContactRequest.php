<?php

namespace Modules\RRHH\Http\Requests\CustomerContact;

use Illuminate\Foundation\Http\FormRequest;

class CustomerContactRequest extends FormRequest
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
                    'title' => 'required',
                    'firstname' => 'required',
                    'lastname' => 'required',
                    'phone_number_1' => 'required',
                    'email' => 'required|email',
                    'customer_id' => 'required',
                ];
                break;

            case 'PUT':
            case 'PATCH':
                return [
                    'title' => 'required',
                    'firstname' => 'required',
                    'lastname' => 'required',
                    'phone_number_1' => 'required',
                    'email' => 'required|email',
                    'customer_id' => 'required',
                ];
                break;

            default:
                break;
        }
    }
}
