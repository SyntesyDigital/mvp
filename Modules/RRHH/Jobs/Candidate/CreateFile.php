<?php

namespace Modules\RRHH\Jobs\Candidate;

use Modules\RRHH\Http\Requests\Admin\Candidate\CreateFileRequest;

class CreateFile
{
    public function __construct($file)
    {
        $this->file = $file;
    }

    public static function fromRequest(CreateFileRequest $request)
    {
        return new self($request->file('file'));
    }

    public function handle()
    {
        $filePath = $this->file->storeAs(
            'public/candidates',
            uniqid(rand(), false).'.'.$this->file->getClientOriginalExtension()
        );

        // $filePath = $this->file->store('public/candidates');

        if ($filePath) {
            return [
                'path' => str_replace('public/candidates/', '', $filePath),
                'date' => date('Y-m-d'),
            ];
        }

        return false;
    }
}
