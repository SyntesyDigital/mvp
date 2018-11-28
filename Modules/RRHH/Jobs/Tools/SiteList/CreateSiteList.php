<?php

namespace Modules\RRHH\Jobs\Tools\SiteList;

use Modules\RRHH\Http\Requests\Admin\Tools\SiteList\CreateSiteListRequest;
use Modules\RRHH\Entities\Tools\SiteList;

class CreateSiteList
{
    public function __construct(array $attributes = [])
    {
        $this->attributes = array_only($attributes, [
            'identifier',
            'name',
            'type',
            'value',
        ]);
    }

    public static function fromRequest(CreateSiteListRequest $request)
    {
        return new self($request->all());
    }

    public function handle()
    {
        return SiteList::create($this->attributes);
    }
}
