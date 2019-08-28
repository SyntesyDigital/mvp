<?php

namespace Modules\Architect\Widgets\Types;

use Modules\Architect\Widgets\Widget;
use Modules\Architect\Widgets\WidgetInterface;

use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\ContentField;
use Modules\Architect\Entities\Language;

class TotalBox extends Widget implements WidgetInterface
{
    public $type = 'widget';
    public $icon = 'fa fa-pencil-square-o';
    public $name = 'TOTAL_BOX';
    public $component = 'CommonWidget';

    public $fields = [
        'name' => 'Modules\Architect\Fields\Types\Text',
        'icon' => 'Modules\Architect\Fields\Types\Text',
    ];

    public $rules = [
        'required'
    ];

    public $hidden = false;

    public $settings = [
        'tableElements'
    ];
}
?>
