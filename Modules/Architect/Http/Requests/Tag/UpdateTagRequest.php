<?php

namespace Modules\Architect\Http\Requests\Tag;

use Illuminate\Foundation\Http\FormRequest;

use Modules\Architect\Entities\Tag;

class UpdateTagRequest extends FormRequest
{

    public function rules()
    {
        return $this->buildRules('fields');
    }

    private function buildRules($fielName)
    {
        $rules = [];
        foreach(Tag::FIELDS as $field) {
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
