<?php

namespace Modules\Architect\Widgets\Types;

use Modules\Architect\Widgets\Widget;
use Modules\Architect\Widgets\WidgetInterface;

use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\ContentField;
use Modules\Architect\Entities\Language;

class TestList extends Widget implements WidgetInterface
{
    public $type = 'widget-list';
    public $icon = 'fa fa-columns';
    public $name = 'TEST_LIST';
    public $widget = 'TEST';

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
