<?php

namespace Modules\Architect\Http\Requests\Content;

use Illuminate\Foundation\Http\FormRequest;

use Modules\Architect\Rules\ContentField;

class CreateContentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'status' => 'required',
            //'typology_id' => 'required',
            'author_id' => 'required',
            'fields' => ['required', new ContentField],

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
