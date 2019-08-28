<?php

namespace Modules\Architect\Widgets\Types;

use Modules\Architect\Widgets\Widget;
use Modules\Architect\Widgets\WidgetInterface;

use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\ContentField;
use Modules\Architect\Entities\Language;

class BoxButton extends Widget implements WidgetInterface
{
    public $type = 'widget';
    public $icon = 'fa fa-external-link';
    public $name = 'BOX_BUTTON';
    public $component = 'CommonWidget';

    public $fields = [
        'url' => 'Modules\Architect\Fields\Types\Url',
        'title' => 'Modules\Architect\Fields\Types\Text',
        'icon' => 'Modules\Architect\Fields\Types\Text',
    ];

    public $rules = [
        'required'
    ];

    public $hidden = false;

    public $settings = [
        'htmlId',
        'htmlClass'
    ];
}
?>
