<?php

namespace Modules\Architect\Tests\Feature\Tasks;

use Modules\Architect\Tests\TestCase;

use Modules\Architect\Tasks\Media\BuildImageCrops;
use Intervention\Image\ImageManagerStatic as Image;

class BuildImageCropsTest extends TestCase
{

    public $filePathHorizontal = __DIR__  . '/image_horizontal.jpg';
    public $filePathVertical = __DIR__  . '/image_vertical.jpg';

    public function testImageHorizontal()
    {
        (new BuildImageCrops($this->filePathHorizontal))->run();

        $original = Image::make($this->filePathHorizontal);

        echo 'Original (horizontal) : ' . $original->width() . 'x' . $original->height() . PHP_EOL;

        // Build others image formats
        foreach(config('images.formats') as $format) {
            $path = sprintf('%s/app/%s/%s/%s',
                storage_path(),
                config('images.storage_directory'),
                $format['directory'],
                basename($this->filePathHorizontal)
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
            //$this->assertSame(intval($height), intval(round($width / $ratio)));

            echo $format["name"] . ' ('.$format["width"].'x'.$format["height"].') : ' . $image->width() . 'x' . $image->height() . PHP_EOL;

            unlink($path);
        }

        echo PHP_EOL;
    }

    public function testImageVertical()
    {
        (new BuildImageCrops($this->filePathVertical))->run();

        $original = Image::make($this->filePathVertical);

        echo 'Original (vertical) : ' . $original->width() . 'x' . $original->height() . PHP_EOL;

        // Build others image formats
        foreach(config('images.formats') as $format) {
            $path = sprintf('%s/app/%s/%s/%s',
                storage_path(),
                config('images.storage_directory'),
                $format['directory'],
                basename($this->filePathVertical)
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
            //$this->assertSame(intval($height), intval(round($width / $ratio)));
            //$this->assertSame(intval($image->width()), intval($format["width"]));

            echo $format["name"] . ' ('.$format["width"].'x'.$format["height"].') : ' . $image->width() . 'x' . $image->height() . PHP_EOL;

            unlink($path);
        }

        echo PHP_EOL;
    }
}
