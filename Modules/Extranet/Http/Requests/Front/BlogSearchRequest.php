<?php

namespace Modules\Extranet\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class BlogSearchRequest extends FormRequest
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
        switch ($this->method()) {
            case 'GET':

                return [
                    'search' => 'required',
                ];

            case 'POST':

                return [
                    'search' => 'required',
                ];

            case 'DELETE':
            case 'POST':
            case 'PUT':
            case 'PATCH':
            default:break;
        }
    }
}
