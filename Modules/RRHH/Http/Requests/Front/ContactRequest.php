<?php

namespace Modules\RRHH\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            case 'POST':
                return [
                    'lastname' => 'required',
                    'name' => 'required',
                    'email' => 'required|email',
                    'subject' => 'required',
                    'message' => 'required',
                ];
                break;

            case 'GET':
            case 'DELETE':
            case 'POST':
            case 'PUT':
            case 'PATCH':
            default:
                break;
        }
    }
}
