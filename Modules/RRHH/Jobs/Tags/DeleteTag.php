<?php

namespace Modules\RRHH\Jobs\Tags;

class DeleteTag
{
    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }

    public function handle()
    {
        return $this->tag->delete() > 0 ? true : false;
    }
}
