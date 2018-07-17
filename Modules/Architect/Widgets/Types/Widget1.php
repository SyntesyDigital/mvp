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
        'title' => 'Modules\Architect\Fields\Types\Text',
        'link' => 'Modules\Architect\Fields\Types\Link',
        'contents' => 'Modules\Architect\Fields\Types\Contents',
        'url' => 'Modules\Architect\Fields\Types\Contents',
        'map' => 'Modules\Architect\Fields\Types\Localization',
        'image' => 'Modules\Architect\Fields\Types\Image',
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
