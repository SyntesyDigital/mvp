<?php

namespace Modules\RRHH\Http\Requests\Admin\Candidate;

use Illuminate\Foundation\Http\FormRequest;

class CandidateRequest extends FormRequest
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
                    'civility' => 'required',
                    'firstname' => 'required',
                    'lastname' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required',
                ];
                break;

            case 'PUT':
            case 'PATCH':
                return [
                    'civility' => 'required',
                    'firstname' => 'required',
                    'lastname' => 'required',
                    'email' => 'required|email|unique:users,email,'.$this->get('id'),
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
        ];
    }
}
