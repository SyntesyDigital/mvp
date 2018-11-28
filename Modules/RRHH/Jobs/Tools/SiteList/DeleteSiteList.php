<?php

namespace Modules\RRHH\Jobs\Tools\SiteList;

use Modules\RRHH\Entities\Tools\SiteList;

class DeleteSiteList
{
    public function __construct(SiteList $siteList)
    {
        $this->siteList = $siteList;
    }

    public function handle()
    {
        return $this->siteList->delete() > 0 ? true : false;
    }
}
