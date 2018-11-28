<?php

namespace Modules\RRHH\Jobs\Tools\FileList;

use Modules\RRHH\Entities\Tools\SiteList;

class GetFileList
{
    public function __construct()
    {
        $this->attributes = [
                            'identifier' => 'doclist',
                            'name' => 'Liste des documents',
                            'type' => 'documents',
                            'value' => '[]',
                            ];
    }

    public function handle()
    {
        $fileList = SiteList::where('type', 'documents')->first();
        if (! $fileList) {
            return SiteList::create($this->attributes);
        }

        return $fileList;
    }
}
