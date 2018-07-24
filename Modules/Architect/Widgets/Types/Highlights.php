<?php

namespace Modules\Architect\Widgets\Types;

use Modules\Architect\Widgets\Widget;
use Modules\Architect\Widgets\WidgetInterface;

use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\ContentField;
use Modules\Architect\Entities\Language;

class Highlights extends Widget implements WidgetInterface
{
    public $type = 'widget-list';
    public $icon = 'fa-th-list';
    public $name = 'HIGHLIGHTS';
    public $widget = 'IMAGE_TEXT_FILE';

    public $rules = [
        'required'
    ];

    public $hidden = false;

    public $settings = [
        'htmlId',
        'htmlClass',
        'cropsAllowed',
    ];
}
?>
