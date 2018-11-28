<?php

namespace Modules\RRHH\Jobs\Agence;

use Modules\RRHH\Http\Requests\Agence\CreateFileRequest;

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
        $filePath = $this->file->store('public/agences');

        if ($filePath) {
            return ['path' => str_replace('public/agences/', '', $filePath),
                         'date' => date('Y-m-d'), ];
        } else {
            return false;
        }
    }
}
