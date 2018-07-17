<?php

namespace Modules\Architect\Widgets\Types;

use Modules\Architect\Widgets\Widget;
use Modules\Architect\Widgets\WidgetInterface;

use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\ContentField;
use Modules\Architect\Entities\Language;

class BannerSlide extends Widget implements WidgetInterface
{
    public $type = 'widget';
    public $icon = 'fa-picture-o';
    public $name = 'BANNER_SLIDE';
    public $component = 'CommonWidget';

    public $fields = [
        [
            "class" => 'Modules\Architect\Fields\Types\Image',
            "identifier" => "image",
            "type" => "image", // <= FIXME
            "name" => "Imatge" // <= FIXME : translate it!
        ],
        [
            "class" => 'Modules\Architect\Fields\Types\Text',
            "identifier" => "title",
            "type" => "text", // <= FIXME
            "name" => "Títol" // <= FIXME : translate it!
        ],
        [
            "class" => 'Modules\Architect\Fields\Types\Text',
            "identifier" => "subtitle",
            "type" => "text", // <= FIXME
            "name" => "Subtítol" // <= FIXME : translate it!
        ],
        [
            "class" => 'Modules\Architect\Fields\Types\Url',
            "identifier" => "url",
            "type" => "url", // <= FIXME : ex : Text::getType()
            "name" => "Enllaç", // <= FIXME : translate it!
        ]
    ];

    public $rules = [
        'required'
    ];

    public $settings = [
        'htmlId',
        'htmlClass',
        'cropsAllowed',
    ];

}
?>
