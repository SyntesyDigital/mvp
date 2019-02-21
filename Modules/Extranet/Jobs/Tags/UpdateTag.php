<?php

namespace Modules\Extranet\Jobs\Tags;

use Modules\Extranet\Entities\Tag;
use Modules\Extranet\Http\Requests\Admin\Tags\UpdateTagRequest;

class UpdateTag
{
    public function __construct(Tag $tag, array $attributes = [])
    {
        $this->tag = $tag;
        $this->attributes = array_only($attributes, [
            'name',
        ]);
    }

    public static function fromRequest(Tag $tag, UpdateTagRequest $request)
    {
        return new self($tag, $request->all());
    }

    public function handle()
    {
        return $this->tag->update($this->attributes) ? true : false;
    }
}
