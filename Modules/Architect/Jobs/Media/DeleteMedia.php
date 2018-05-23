<?php

namespace App\Jobs\Content\Media;

use Modules\Architect\Http\Requests\Media\DeleteMediaRequest;
use Modules\Architect\Entities\Media;

class DeleteMedia
{
    public function __construct(Media $media)
    {
        $this->media = $media;
    }

    public static function fromRequest(DeleteMediaRequest $request)
    {
        return new self(Media::find($request->get('id')));
    }

    public function handle()
    {
        return $this->media->delete();
    }
}
