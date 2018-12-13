<?php

namespace Modules\RRHH\Jobs\Tags;

use Modules\RRHH\Entities\Tag;
use Modules\RRHH\Http\Requests\Admin\Tags\CreateTagRequest;

class CreateTag
{
    public function __construct(array $attributes = [])
    {
        $this->attributes = array_only($attributes, [
            'name',
        ]);
    }

    public static function fromRequest(CreateTagRequest $request)
    {
        return new self($request->all());
    }

    public function handle()
    {
        return Tag::create($this->attributes);
    }
}
