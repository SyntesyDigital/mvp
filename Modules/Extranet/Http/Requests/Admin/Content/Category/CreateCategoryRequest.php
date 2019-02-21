<?php

namespace Modules\Extranet\Http\Requests\Admin\Content\Category;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
            //'title' => 'required',
            'identifier' => 'required|unique:categories',
        ];
    }
}
