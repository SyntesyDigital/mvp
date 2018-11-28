<?php

namespace Modules\RRHH\Http\Requests\Candidate;

use Illuminate\Foundation\Http\FormRequest;
use Validator;

class CandidateCVRequest extends FormRequest
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
        Validator::extend('file_extension', function ($attribute, $value, $parameters, $validator) {
            $regexPattern = '/\.pdf$|\.doc$|\.docx$/';
            $filename = $value->getClientOriginalName();

            return preg_match($regexPattern, $filename);
        });

        return [
            'resume_file' => 'required|file_extension',
        ];
    }
}
