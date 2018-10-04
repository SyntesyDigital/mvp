<?php

namespace Modules\Architect\Tests\Feature\Tasks;

use Modules\Architect\Tests\TestCase;

use Modules\Architect\Tasks\Media\BuildImageCrops;
use Intervention\Image\ImageManagerStatic as Image;

class BuildImageCropsTest extends TestCase
{

    public $filePath = __DIR__  . '/image.jpg';

    public function test()
    {
        (new BuildImageCrops($this->filePath))->run();

        $original = Image::make($this->filePath);

        // Build others image formats
        foreach(config('images.formats') as $format) {
            $path = sprintf('%s/app/%s/%s/%s',
                storage_path(),
                config('images.storage_directory'),
                $format['directory'],
                basename($this->filePath)
            );

            // Test if crops is created
            $this->assertFileExists($path);

            // Test crop format
            $image = Image::make($path);

            $ratio = explode(':', $format["ratio"]);
            $ratio = $ratio[0] / $ratio[1];

            $width = $image->width() > $format["width"] ? $format["width"] : $image->width();
            $height = $image->height() > $format["height"] ? $format["height"] : $image->height();

            // Test Ratio
            $this->assertSame(intval($height), intval(round($width / $ratio)));
            //$this->assertSame(intval($image->width()), intval($format["width"]));

            // Does the crop width must be fit to the format width ? 

            // echo $image->width() . ' : ' . $format["width"];
            // echo PHP_EOL;


            unlink($path);
        }
    }
}
