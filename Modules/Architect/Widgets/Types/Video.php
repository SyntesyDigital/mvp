<?php

namespace Modules\Architect\Widgets\Types;

use Modules\Architect\Widgets\Widget;
use Modules\Architect\Widgets\WidgetInterface;

use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\ContentField;
use Modules\Architect\Entities\Language;

class Video extends Widget implements WidgetInterface
{
    public $type = 'widget';
    public $icon = 'fa-file-video-o';
    public $name = 'VIDEO';
    public $component = 'CommonWidget';

    public $fields = [
        'video' => 'Modules\Architect\Fields\Types\Contents'
    ];

    public $rules = [
        'required'
    ];

    public $settings = [
        'htmlId',
        'htmlClass',
        'typologyAllowed',
        'maxItems'
    ];

}
?>
