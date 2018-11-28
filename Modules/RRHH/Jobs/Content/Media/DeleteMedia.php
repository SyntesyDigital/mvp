<?php

namespace Modules\RRHH\Jobs\Content\Media;

use Modules\RRHH\Http\Requests\Admin\Content\Media\DeleteMediaRequest;
use Modules\RRHH\Entities\Content\Media;

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
