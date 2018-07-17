<?php

namespace Modules\Architect\Widgets\Types;

use Modules\Architect\Widgets\Widget;
use Modules\Architect\Widgets\WidgetInterface;

use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\ContentField;
use Modules\Architect\Entities\Language;

class ImageTextLink extends Widget implements WidgetInterface
{
    public $type = 'widget';
    public $icon = 'fa-file-o';
    public $name = 'IMAGE_TEXT_LINK';
    public $component = 'CommonWidget';

    public $fields = [
        [
            "class" => 'Modules\Architect\Fields\Types\Image',
            "identifier" => "image",
            "type" => "image", // <= FIXME
            "name" => "Imatge" // <= FIXME : translate it!
        ],
        [
            "class" => 'Modules\Architect\Fields\Types\Link',
            "identifier" => "link",
            "type" => "link", // <= FIXME : ex : Text::getType()
            "name" => "Enllaç", // <= FIXME : translate it!
        ],
        [
            "class" => 'Modules\Architect\Fields\Types\RichText',
            "identifier" => "rich",
            "type" => "richtext", // <= FIXME : ex : Text::getType()
            "name" => "Descripció", // <= FIXME : translate it!
        ]

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
