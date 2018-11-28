<?php

namespace Modules\RRHH\Jobs\Content\Content;

use Modules\RRHH\Http\Requests\Admin\Content\Media\DeleteContentRequest;
use Modules\RRHH\Entities\Content\Content;

class DeleteContent
{
    public function __construct(Content $content)
    {
        $this->content = $content;
    }

    public static function fromRequest(DeleteContentRequest $request)
    {
        return new self(Content::find($request->get('id')));
    }

    public function handle()
    {
        if ($this->content->delete()) {
            return true;
        }

        return false;
    }
}
