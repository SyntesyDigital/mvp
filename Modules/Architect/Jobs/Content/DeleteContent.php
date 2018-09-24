<?php

namespace Modules\Architect\Jobs\Content;

use Modules\Architect\Http\Requests\Content\DeleteContentRequest;
use Modules\Architect\Entities\Content;

use Illuminate\Support\Facades\Schema;

class DeleteContent
{
    public function __construct(Content $content)
    {
        $this->content = $content;
    }

    public static function fromRequest(Content $content, DeleteContentRequest $request)
    {
        return new self($content);
    }

    public function handle()
    {
        Schema::disableForeignKeyConstraints();
        $this->content->unindex();
        $result = $this->content->delete();
        Schema::enableForeignKeyConstraints();

        return $result;
    }
}
