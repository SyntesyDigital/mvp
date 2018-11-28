<?php

namespace Modules\RRHH\Http\Requests\Candidate;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class SpontaniousRequest extends FormRequest
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
                    'civility' => 'required',
                    'postal_code' => 'required',
                    'location' => 'required',
                    'telephone' => 'required',
                    'firstname' => 'required',
                    'lastname' => 'required',
                    'message' => 'required',
                    //'job_1' => 'required',
                    'resume_file' => 'required',
                    'email' => Auth::check()
                        ? 'required|email|unique:users,email,'.Auth::user()->id
                        : 'required|email|unique:users',
                ];
            break;

            case 'PUT':
            case 'PATCH':
                return [
                    'civility' => 'required',
                    'postal_code' => 'required',
                    'telephone' => 'required',
                    'firstname' => 'required',
                    'lastname' => 'required',
                    'message' => 'required',
                    'resume_file' => 'required',
                    'location' => 'required',
                    //'job_1' => 'required',
                    'email' => Auth::check()
                        ? 'required|email|unique:users,email,'.Auth::user()->id
                        : 'required|email|unique:users',
                ];
                break;

            default:
                break;
        }
    }

    public function messages()
    {
        return [
            'email.required' => ' ',
            'location.required' => 'Vous devez indiquer une ville',
            'email.unique' => 'Cette adresse e-mail est déjà utilisée',
            'resume_file.required' => 'Vous devez envoyer votre C.V.',
        ];
    }
}
