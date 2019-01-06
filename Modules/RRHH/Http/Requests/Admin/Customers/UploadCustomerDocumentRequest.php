<?php

namespace Modules\RRHH\Http\Requests\Admin\Customers;

use Illuminate\Foundation\Http\FormRequest;

class UploadCustomerDocumentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'file' => 'required|mimes:jpg,jpeg,png,pdf,doc',
        ];
    }
}
