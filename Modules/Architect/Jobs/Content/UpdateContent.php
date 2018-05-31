<?php

namespace Modules\Architect\Jobs\Content;

use Modules\Architect\Http\Requests\Content\CreateContentRequest;
use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\ContentField;

class UpdateContent
{
     public function __construct(Content $content, $attributes)
     {
         $this->content = $content;
         $this->attributes = array_only($attributes, [
             'status',
             'typology_id',
             'user_id',
             'fields'
         ]);
     }

    public static function fromRequest(Content $content, CreateContentRequest $request)
    {
        return new self($content, $request->all());
    }

    public function handle()
    {
        print_r($this->attributes);
    }
}
