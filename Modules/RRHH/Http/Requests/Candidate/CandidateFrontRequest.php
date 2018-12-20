<?php

namespace Modules\RRHH\Http\Requests\Candidate;

use Illuminate\Foundation\Http\FormRequest;

class CandidateFrontRequest extends FormRequest
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
            break;

            case 'POST':
                return [
                    'telephone' => 'required',
                    'firstname' => 'required',
                    'lastname' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'postal_code' => 'required',
                    'location' => 'required',
                ];
            break;

            case 'PUT':
            case 'PATCH':
                return [
                    'telephone' => 'required',
                    'firstname' => 'required',
                    'lastname' => 'required',
                    'email' => 'required|email|unique:users,email',
                ];
            break;

            default:
            break;
        }
    }

    public function messages()
    {
        return [
            'email.unique' => 'Cette addresse e-mail est déjà utilisée',
            'postal_code.required' => 'Le code postal est obligatoire',
            'location.required' => 'La ville est obligatoire',
        ];
    }

}
