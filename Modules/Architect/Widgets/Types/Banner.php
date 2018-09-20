<?php

namespace Modules\Architect\Widgets\Types;

use Modules\Architect\Widgets\Widget;
use Modules\Architect\Widgets\WidgetInterface;

use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\ContentField;
use Modules\Architect\Entities\Language;

class Banner extends Widget implements WidgetInterface
{
    public $type = 'widget';
    public $icon = 'fa-puzzle-piece';
    public $name = 'BANNER';
    public $component = 'CommonWidget';

    public $fields = [
        'banner' => 'Modules\Architect\Fields\Types\Contents'
    ];

    public $rules = [
        'required'
    ];

    public $hidden = false;

    public $settings = [
        'htmlId',
        'htmlClass',
        'typologyAllowed',
        'maxItems'
    ];

}
?>
