<?php

namespace Modules\RRHH\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SendMassmailRequest extends FormRequest
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
            'subject' => 'required',
            'reply_to' => 'required|email',
            'message' => 'required',
            'recipients' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'recipients.required' => 'Vous devez choisir au moins un groupe de destinataires'
        ];
    }
}
