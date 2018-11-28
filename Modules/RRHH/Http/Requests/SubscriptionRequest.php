<?php

namespace Modules\RRHH\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionRequest extends FormRequest
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
        return [
            'lastname' => 'required|string',
            'firstname' => 'required|string',
            'email_signup' => 'required|email|unique:users,email',
            'comment_on_signup' => '',
        ];
    }
}
