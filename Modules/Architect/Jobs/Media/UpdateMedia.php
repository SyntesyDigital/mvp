<?php

namespace Modules\Architect\Jobs\Media;

use Modules\Architect\Http\Requests\Media\UpdateMediaRequest;
use Modules\Architect\Entities\Media;

use Intervention\Image\ImageManagerStatic as Image;
use Storage;
use Auth;

class UpdateMedia
{
    private $fields = [
        'metadata'
    ];

    public function __construct(Media $media, $attributes = [])
    {
        $this->media = $media;
        $this->attributes = array_only($attributes, $this->fields);
    }

    public static function fromRequest(Media $media, UpdateMediaRequest $request)
    {
        return new self($media, $request->all());
    }


    public function handle()
    {
        if(is_array($this->media->metadata)) {
            $metadata = isset($this->attributes["metadata"])
                ? array_merge($this->media->metadata, $this->attributes["metadata"])
                : $this->media->metadata;
        } else {
            $metadata = isset($this->attributes["metadata"])
                ? array_merge(json_decode($this->media->metadata, true), $this->attributes["metadata"])
                : $this->media->metadata;
        }

        if($this->media->update([
            'metadata' => $metadata
        ])) {
            return true;
        }

        return false;
    }
}
