<?php

namespace Modules\Extranet\Jobs\Tags;

use Modules\Extranet\Http\Requests\Admin\Tags\DeleteTagRequest;
use Modules\Extranet\Entities\Tag;

class DeleteTag
{
    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }

    public static function fromRequest(Tag $tag, DeleteTagRequest $request)
    {
        return new self($request->all());
    }

    public function handle()
    {
        return $this->tag->delete() > 0 ? true : false;
    }
}
