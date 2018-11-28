<?php

namespace Modules\RRHH\Jobs\Candidate;

use Storage;

class DeleteFile
{
    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    public function handle()
    {
        return Storage::delete('public/candidates/'.$this->filename);
    }
}
