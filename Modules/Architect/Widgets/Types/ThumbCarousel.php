<?php

namespace Modules\Architect\Widgets\Types;

use Modules\Architect\Widgets\Widget;
use Modules\Architect\Widgets\WidgetInterface;

use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\ContentField;
use Modules\Architect\Entities\Language;

class ThumbCarousel extends Widget implements WidgetInterface
{
    public $type = 'widget-list';
    public $icon = 'fa-th-list';
    public $name = 'THUMB_CAROUSEL';
    public $widget = 'THUMB_SLIDE';

    public $rules = [
        'required'
    ];

    public $settings = [
        'htmlId',
        'htmlClass',
        'cropsAllowed',
        'title'
    ];
}
?>
