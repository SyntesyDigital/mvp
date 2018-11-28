<?php

namespace Modules\RRHH\Http\Requests\Agence;

use Illuminate\Foundation\Http\FormRequest;

class AgenceRequest extends FormRequest
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
                    'slug' => 'required',
                    'content' => 'required',
                    'email' => 'required|email',
                    'phone' => 'required',
                    'address' => 'required',
                    'postal_code' => 'required',
                ];
                break;

            case 'PUT':
            case 'PATCH':
                return [
                    'name' => 'required',
                    'slug' => 'required',
                    'content' => 'required',
                    'email' => 'required|email',
                    'phone' => 'required',
                    'address' => 'required',
                    'postal_code' => 'required',
                ];
                break;

            default:
                break;
        }
    }
}
