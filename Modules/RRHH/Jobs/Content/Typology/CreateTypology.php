<?php

namespace Modules\RRHH\Jobs\Content\Typology;

use Modules\RRHH\Http\Requests\Admin\Content\Typology\CreateTypologyRequest;
use Modules\RRHH\Entities\Content\Typology;

class CreateTypology
{
    public function __construct(array $attributes = [])
    {
        $this->attributes = array_only($attributes, [
            'name',
            'identifier',
            'definition',
            'customizable',
            'display_menu',
        ]);
    }

    public static function fromRequest(CreateTypologyRequest $request)
    {
        return new self($request->all());
    }

    public function handle()
    {
        return Typology::create($this->attributes);
    }
}
