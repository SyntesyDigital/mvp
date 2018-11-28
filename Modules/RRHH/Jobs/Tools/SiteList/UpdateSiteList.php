<?php

namespace Modules\RRHH\Jobs\Tools\SiteList;

use Modules\RRHH\Http\Requests\Admin\Tools\SiteList\UpdateSiteListRequest;
use Modules\RRHH\Entities\Tools\SiteList;

class UpdateSiteList
{
    private $fields = [
            'identifier',
            'name',
            'type',
            'value',
    ];

    public function __construct(SiteList $sitelist, array $attributes = [])
    {
        $this->attributes = array_only($attributes, $this->fields);
        $this->sitelist = $sitelist;
    }

    public static function fromRequest($sitelist, UpdateSiteListRequest $request)
    {
        return new self($sitelist, $request->all());
    }

    public function handle()
    {
        $this->sitelist->update($this->attributes);

        return true;
    }
}
