<?php

namespace Modules\Architect\Widgets\Types;

use Modules\Architect\Widgets\Widget;
use Modules\Architect\Widgets\WidgetInterface;

use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\ContentField;
use Modules\Architect\Entities\Language;

class TitleImage extends Widget implements WidgetInterface
{
    public $type = 'widget';
    public $icon = 'fa-font';
    public $name = 'TITLE_IMAGE';
    public $component = 'CommonWidget';

    public $fields = [
        'title' => 'Modules\Architect\Fields\Types\Text',
        'slug' => 'Modules\Architect\Fields\Types\Slug',
        'image' => 'Modules\Architect\Fields\Types\Image',
    ];

    // public $fields = [
    //     [
    //         "class" => 'Modules\Architect\Fields\Types\Text',
    //         "identifier" => "title",
    //         "type" => "text", // <= FIXME : ex : Text::getType()
    //         "name" => "Títol", // <= FIXME : translate it!
    //     ],
    //     [
    //         "class" => 'Modules\Architect\Fields\Types\Text',
    //         "identifier" => "slug",
    //         "type" => "text", // <= FIXME
    //         "name" => "Slug" // <= FIXME : translate it!
    //     ],
    //     [
    //         "class" => 'Modules\Architect\Fields\Types\Image',
    //         "identifier" => "image",
    //         "type" => "image", // <= FIXME
    //         "name" => "Image" // <= FIXME : translate it!
    //     ],
    // ];

    public $rules = [
        'required'
    ];

    public $settings = [
        'htmlId',
        'htmlClass'
    ];

}
?>
