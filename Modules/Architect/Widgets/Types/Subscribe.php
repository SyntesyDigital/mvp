<?php

namespace Modules\Architect\Widgets\Types;

use Modules\Architect\Widgets\Widget;
use Modules\Architect\Widgets\WidgetInterface;

use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\ContentField;
use Modules\Architect\Entities\Language;

class Subscribe extends Widget implements WidgetInterface
{
    public $type = 'widget';
    public $icon = 'fa-file-o';
    public $name = 'SUBSCRIBE';
    public $component = 'CommonWidget';

    public $fields = [
        [
            "class" => 'Modules\Architect\Fields\Types\Link',
            "identifier" => "link",
            "type" => "link", // <= FIXME
            "name" => "Enllaç" // <= FIXME : translate it!
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
