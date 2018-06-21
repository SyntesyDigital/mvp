<?php

namespace Modules\Architect\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

use Modules\Architect\Entities\Category;

class CreateCategoryRequest extends FormRequest
{
    public function rules()
    {        
        return [
            'fields.ca.name' => 'required',
            'fields.slug' => 'required'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
