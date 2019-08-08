<?php

namespace Modules\Architect\Widgets\Types;

use Modules\Architect\Widgets\Widget;
use Modules\Architect\Widgets\WidgetInterface;

use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\ContentField;
use Modules\Architect\Entities\Language;

class Test extends Widget implements WidgetInterface
{
    public $type = 'widget';
    public $icon = 'fa fa-columns';
    public $name = 'TEST';
    public $component = 'CommonWidget';

    public $fields = [
        'title' => 'Modules\Architect\Fields\Types\Text',
        'description' => 'Modules\Architect\Fields\Types\RichText',
        'image' => 'Modules\Architect\Fields\Types\Image',
        'images' => 'Modules\Architect\Fields\Types\Images',
        'link' => 'Modules\Architect\Fields\Types\Link',
        'url' => 'Modules\Architect\Fields\Types\Url',
        'contents' => 'Modules\Architect\Fields\Types\Contents',
        'file' => 'Modules\Architect\Fields\Types\File',
        'translated_file' => 'Modules\Architect\Fields\Types\TranslatedFile',
    ];

    public $rules = [
        'required'
    ];

    public $hidden = false;

    public $settings = [
        'collapsable',
        'collapsed',
        'doubleColumn'
    ];
}
?>
