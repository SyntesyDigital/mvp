<?php

namespace Modules\Front\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveContactWithSelectionRequest extends FormRequest
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
            'email' => 'required|email',
            'country' => 'required',
            'company' => 'required',
            'items' => 'required',
            'items_value' => 'required',
            'typology' => 'required',
            'privacity' => 'required|accepted',
            'conditions' => 'required|accepted',
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
