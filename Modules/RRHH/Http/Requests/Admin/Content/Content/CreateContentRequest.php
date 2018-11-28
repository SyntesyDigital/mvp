<?php

namespace Modules\RRHH\Http\Requests\Admin\Content\Content;

use Illuminate\Foundation\Http\FormRequest;

class CreateContentRequest extends FormRequest
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
            'inputs' => 'required',
            'typology_id' => 'required',
            //'status' => 'required'
        ];
    }
}
