<?php

namespace Modules\Architect\Widgets\Types;

use Modules\Architect\Widgets\Widget;
use Modules\Architect\Widgets\WidgetInterface;

use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\ContentField;
use Modules\Architect\Entities\Language;

class ImageTextFile extends Widget implements WidgetInterface
{
    public $type = 'widget';
    public $icon = 'fa-file-o';
    public $name = 'IMAGE_TEXT_FILE';
    public $component = 'CommonWidget';

    public $fields = [
        'image' => 'Modules\Architect\Fields\Types\Image',
        'link' => 'Modules\Architect\Fields\Types\Link',
        'description' => 'Modules\Architect\Fields\Types\RichText',
        'file' => 'Modules\Architect\Fields\Types\File'
    ];

    public $rules = [
        'required'
    ];

    public $settings = [
        'htmlId',
        'htmlClass'
    ];

}
?>
