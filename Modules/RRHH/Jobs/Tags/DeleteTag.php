<?php

namespace Modules\RRHH\Jobs\Tags;

use Modules\RRHH\Http\Requests\Admin\Tags\DeleteTagRequest;
use Modules\RRHH\Entities\Tag;

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
