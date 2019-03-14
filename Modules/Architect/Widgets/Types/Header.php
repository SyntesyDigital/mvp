<?php

namespace Modules\Architect\Widgets\Types;

use Modules\Architect\Widgets\Widget;
use Modules\Architect\Widgets\WidgetInterface;

use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\ContentField;
use Modules\Architect\Entities\Language;

class Header extends Widget implements WidgetInterface
{
    public $type = 'widget';
    public $icon = 'fa-font';
    public $name = 'HEADER';
    public $component = 'CommonWidget';

    public $fields = [
        'description' => 'Modules\Architect\Fields\Types\RichText',
    ];

    public $rules = [
        'required'
    ];

    //public $hidden = true;

    public $settings = [
        'htmlId',
        'htmlClass'
    ];

}
?>
