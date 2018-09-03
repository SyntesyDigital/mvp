<?php

namespace Modules\Turisme\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SavePressRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'media_type' => 'required',
            'media_name' => 'required',
            'media_distribution' => 'required',
            'media_country' => 'required',
            'media_web' => 'required',
            'media_email' => 'required|email',
            'media_comment' => 'required',

            'firstname' => 'required',
            'lastname' => 'required',
            'gender' => 'required',
            'country' => 'required',
            'occupation' => 'required',
            'email' => 'required|email',
            'web' => 'required',
            'language' => 'required',
            'dateStart' => 'required',
            'dateEnd' => 'required',
            'comment' => 'required',

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
