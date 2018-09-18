<?php

namespace Modules\Architect\Jobs\Media;

use Modules\Architect\Http\Requests\Media\CreateMediaRequest;
use Modules\Architect\Entities\Media;

use Intervention\Image\ImageManagerStatic as Image;
use Storage;
use Auth;

class CreateMedia
{

    private $filePath = null;
    private $metadata = null;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public static function fromRequest(CreateMediaRequest $request)
    {
        return new self($request->file('file'));
    }

    private function getFileMimeType()
    {
        return $this->file->getMimeType();
    }

    private function getFileType()
    {
        return explode('/', $this->getFileMimeType())[0] ?: null;
    }

    private function processImage()
    {
        $this->filePath = $this->file->store(config('images.storage_directory') . '/original');

        if ($this->filePath) {

            // Build others image formats
            foreach(config('images.formats') as $format) {

                $image = Image::make(storage_path() . '/app/' . $this->filePath);

                $width = $image->width() > $format["width"] ? $format["width"] : $image->width();
                $height = $image->height() > $format["height"] ? $format["height"] : $image->height();

                $imageData = $image
                    ->fit($width, $height, null, "center")
                    ->crop($width, $height)
                    ->encode();

                $path = sprintf('%s/%s/%s',
                    config('images.storage_directory'),
                    $format['directory'],
                    basename($this->filePath)
                );

                Storage::put($path, (string) $imageData);
            }

            // Build medatadata
            $image = Image::make(storage_path() . '/app/' . $this->filePath);

            $this->metadata = [
                'filesize' => number_format($image->filesize() / 1000, 2, ',', ' '),
                'dimension' => sprintf('%dx%d', $image->width(), $image->height()),
            ];

            return true;
        }

        return false;
    }

    private function processFile()
    {
        $this->filePath = $this->file->store('public/medias/files');
    }


    public function handle()
    {
        switch ($this->getFileType()) {
            case 'image':
                $this->processImage();
            break;

            default:
                $this->processFile();
            break;
        }

        return $this->filePath
            ? Media::create([
                'stored_filename' => basename($this->filePath),
                'uploaded_filename' => $this->file->getClientOriginalName(),
                'type' => $this->getFileType(),
                'mime_type' => $this->getFileMimeType(),
                'author_id' => Auth::user()->id,
                'metadata' => $this->metadata ? $this->metadata : null
            ])
            : false;
    }
}
