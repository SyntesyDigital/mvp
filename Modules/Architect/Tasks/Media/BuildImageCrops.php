<?php

namespace Modules\Architect\Tasks\Media;

use Intervention\Image\ImageManagerStatic as Image;
use Storage;

class BuildImageCrops
{
    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    public function run()
    {
        // Build others image formats
        foreach(config('images.formats') as $format) {

            $image = Image::make($this->filePath);

            $width = $image->width() > $format["width"] ? $format["width"] : $image->width();
            $height = $image->height() > $format["height"] ? $format["height"] : $image->height();

            $ratio = explode(':', $format["ratio"]);
            $ratio = $ratio[0] / $ratio[1];

            $imageData = $image
                ->fit($width, $height, function ($constraint) { // http://image.intervention.io/api/fit
                    $constraint->upsize();
                })
                ->crop($width, $height)
                ->encode();

            $path = sprintf('%s/%s/%s',
                config('images.storage_directory'),
                $format['directory'],
                basename($this->filePath)
            );

            Storage::put($path, (string) $imageData);
        }
    }

}
