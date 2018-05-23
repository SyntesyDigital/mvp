<?php

namespace Modules\Architect\Jobs\Content\Media;

use Modules\Architect\Http\Requests\Media\CreateMediaRequest;
use Modules\Architect\Entities\Media;

use Intervention\Image\ImageManagerStatic as Image;
use Storage;

class CreateMedia
{
    public function __construct($file)
    {
        $this->file = $file;
    }

    public static function fromRequest(CreateMediaRequest $request)
    {
        return new self($request->file('file'));
    }

    public function handle()
    {
        $filePath = $this->file->store('public/medias');

        if ($filePath) {


            $mime = $this->file->getMimeType();
            $type = explode('/', $mime)[0] ?: null;

            // Pre-processing...
            switch ($type) {
                case 'image':
                    $imageData = Image::make(storage_path().'/app/'.$filePath)
                        ->resize(null, 1024, function ($constraint) {
                            $constraint->aspectRatio();
                            $constraint->upsize();
                        })
                        ->encode();

                    Storage::put($filePath, (string) $imageData);
                break;
            }

            return Media::create([
                 'stored_filename' => basename($filePath),
                 'uploaded_filename' => $this->file->getClientOriginalName(),
                 'type' => $type,
                 'mime_type' => $mime,
             ]);
        }

        return false;
    }
}
