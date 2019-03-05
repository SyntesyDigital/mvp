<?php

namespace Modules\Front\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveNewsletterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|confirmed',
            'email_confirmation' => 'required|email',
            'country' => 'required',
            'language' => 'required',
            'company' => 'required',
            'occupation' => 'required',
            'privacity' => 'required|accepted',
            //'newsletter' => 'required|accepted',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
