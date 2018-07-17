<?php

namespace Modules\Architect\Widgets\Types;

use Modules\Architect\Widgets\Widget;
use Modules\Architect\Widgets\WidgetInterface;

use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\ContentField;
use Modules\Architect\Entities\Language;

class WidgetList1 extends Widget implements WidgetInterface
{
    public $type = 'widget-list';
    public $icon = 'fa-font';
    public $name = 'WIDGET_LIST_1';
    public $widget = 'WIDGET_2';

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
