<?php

namespace Modules\RRHH\Http\Requests\Candidate;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class CandidateEditRequest extends FormRequest
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
                    'email' => 'required|email|unique:users,email,'.Auth::user()->id,
                    'password' => 'sometimes|nullable|min:6|confirmed',
                    'location' => 'required',
                    'postal_code' => 'required',
                    'birthday' => 'nullable|date_format:d/m/Y',
                ];
            break;

            case 'PUT':
            case 'PATCH':
                return [
                    'telephone' => 'required',
                    'firstname' => 'required',
                    'lastname' => 'required',
                    'email' => 'required|email',
                    'location' => 'required',
                    'postal_code' => 'required',
                    'birthday' => 'date_format:d/m/Y',
                ];
            break;

            default:
            break;
        }
    }
}
