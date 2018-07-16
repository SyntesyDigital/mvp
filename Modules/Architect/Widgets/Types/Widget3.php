<?php

namespace Modules\Architect\Widgets\Types;

use Modules\Architect\Widgets\Widget;
use Modules\Architect\Widgets\WidgetInterface;

use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\ContentField;
use Modules\Architect\Entities\Language;

class Widget3 extends Widget implements WidgetInterface
{
    public $type = 'widget';
    public $icon = 'fa-font';
    public $name = 'WIDGET_3';
    public $component = 'CommonWidget';

    public $fields = [
        [
            "class" => 'Modules\Architect\Fields\Types\Text',
            "identifier" => "title",
            "type" => "text", // <= FIXME : ex : Text::getType()
            "name" => "Títol", // <= FIXME : translate it!
        ],
        [
            "class" => 'Modules\Architect\Fields\Types\RichText',
            "identifier" => "description",
            "type" => "richtext", // <= FIXME : ex : Text::getType()
            "name" => "Description", // <= FIXME : translate it!
        ],
        [
            "class" => 'Modules\Architect\Fields\Types\Image',
            "identifier" => "image",
            "type" => "image", // <= FIXME : ex : Text::getType()
            "name" => "Image", // <= FIXME : translate it!
        ],
    ];

    public $rules = [
        'required'
    ];

    public $settings = [
        'htmlId',
        'htmlClass',
        'allowedTypologies'
    ];

}
?>
