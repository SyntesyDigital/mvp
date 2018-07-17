<?php

namespace Modules\Architect\Widgets\Types;

use Modules\Architect\Widgets\Widget;
use Modules\Architect\Widgets\WidgetInterface;

use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\ContentField;
use Modules\Architect\Entities\Language;

class Widget1 extends Widget implements WidgetInterface
{
    public $type = 'widget';
    public $icon = 'fa-font';
    public $name = 'WIDGET_1';
    public $component = 'CommonWidget';

    public $fields = [
        [
            "class" => 'Modules\Architect\Fields\Types\Text',
            "identifier" => "title",
            "type" => "text", // <= FIXME : ex : Text::getType()
            "name" => "Títol", // <= FIXME : translate it!
        ],
        [
            "class" => 'Modules\Architect\Fields\Types\Link',
            "identifier" => "link",
            "type" => "link", // <= FIXME
            "name" => "Link" // <= FIXME : translate it!
        ],
        [
            "class" => 'Modules\Architect\Fields\Types\Contents',
            "identifier" => "contents",
            "type" => "contents", // <= FIXME
            "name" => "Contents" // <= FIXME : translate it!
        ],
        [
            "class" => 'Modules\Architect\Fields\Types\Url',
            "identifier" => "url",
            "type" => "url", // <= FIXME
            "name" => "Url" // <= FIXME : translate it!
        ],
        [
            "class" => 'Modules\Architect\Fields\Types\Localization',
            "identifier" => "map",
            "type" => "localization", // <= FIXME
            "name" => "Map" // <= FIXME : translate it!
        ],
        [
            "class" => 'Modules\Architect\Fields\Types\Image',
            "identifier" => "image",
            "type" => "image", // <= FIXME
            "name" => "Image" // <= FIXME : translate it!
        ]
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
