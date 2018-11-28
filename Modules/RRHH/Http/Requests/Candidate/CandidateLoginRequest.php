<?php

namespace Modules\RRHH\Http\Requests\Candidate;

use Illuminate\Foundation\Http\FormRequest;

class CandidateLoginRequest extends FormRequest
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
                    'password' => 'required',
                    'email' => 'required|email|exists:users,email',
                ];

            case 'PUT':
            case 'PATCH':

                return [
                    'password' => 'required',
                    'email' => 'required|email|exists:users,email',
                ];

            default:break;
        }
    }
}
