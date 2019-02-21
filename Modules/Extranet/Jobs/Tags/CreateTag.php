<?php

namespace Modules\Extranet\Jobs\Tags;

use Modules\Extranet\Entities\Tag;
use Modules\Extranet\Http\Requests\Admin\Tags\CreateTagRequest;

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
