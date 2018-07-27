<?php

namespace Modules\Architect\Widgets\Types;

use Modules\Architect\Widgets\Widget;
use Modules\Architect\Widgets\WidgetInterface;

use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\ContentField;
use Modules\Architect\Entities\Language;

class Testimonial extends Widget implements WidgetInterface
{
    public $type = 'widget';
    public $icon = 'fa-comment';
    public $name = 'TESTIMONIAL';
    public $component = 'CommonWidget';

    public $fields = [
        'message' => 'Modules\Architect\Fields\Types\RichText',
        'title' => 'Modules\Architect\Fields\Types\Text',
        'company' => 'Modules\Architect\Fields\Types\Text'
    ];

    public $rules = [
        'required'
    ];

    public $hidden = true;

    public $settings = [
        'htmlId',
        'htmlClass'
    ];

}
?>
