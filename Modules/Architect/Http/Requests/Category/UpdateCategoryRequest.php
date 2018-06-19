<?php

namespace Modules\Architect\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

use Modules\Architect\Entities\Category;

class UpdateCategoryRequest extends FormRequest
{

    public function rules()
    {
        return $this->buildRules('fields');
    }

    private function buildRules($fielName)
    {
        $rules = [];
        foreach(Category::FIELDS as $field) {
            $required = isset($field['required']) ? $field['required'] : false;

            if($required) {
                $rules[$fielName . '.' . $field['identifier']] = 'required';
            }
        }

        return $rules;
    }

    public function authorize()
    {
        return true;
    }
}
