<?php

namespace Modules\Architect\Jobs\Tag;

use Modules\Architect\Http\Requests\Tag\CreateTagRequest;

use Modules\Architect\Entities\Tag;
use Modules\Architect\Entities\TagField;
use Modules\Architect\Entities\Language;

class CreateTag
{
    public function __construct($attributes)
    {
        $fields = collect(Tag::FIELDS)
            ->keyBy('identifier')
            ->keys()
            ->toArray();

        $this->attributes = array_only($attributes['fields'], $fields);
    }

    public static function fromRequest(CreateTagRequest $request)
    {
        return new self($request->all());
    }

    public function handle()
    {
    }
}
