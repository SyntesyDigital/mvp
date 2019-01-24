<?php

namespace Modules\RRHH\Http\Requests\Admin\Candidate;

use Illuminate\Foundation\Http\FormRequest;

class UploadCandidateDocumentRequest extends FormRequest
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
