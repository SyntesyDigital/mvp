<?php

namespace Modules\Architect\Http\Requests\Tag;

use Illuminate\Foundation\Http\FormRequest;

use Modules\Architect\Entities\Tag;

class CreateTagRequest extends FormRequest
{
    public function rules()
    {
        return [
            'fields.name' => 'required',
            'fields.slug' => 'required'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
