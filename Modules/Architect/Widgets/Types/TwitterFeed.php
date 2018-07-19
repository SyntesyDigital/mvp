<?php

namespace Modules\Architect\Widgets\Types;

use Modules\Architect\Widgets\Widget;
use Modules\Architect\Widgets\WidgetInterface;

use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\ContentField;
use Modules\Architect\Entities\Language;

class TwitterFeed extends Widget implements WidgetInterface
{
    public $type = 'widget';
    public $icon = 'fa-twitter';
    public $name = 'TWITTER_FEED';
    public $component = 'CommonWidget';

    public $fields = [
        'user' => 'Modules\Architect\Fields\Types\Text'
    ];

    public $rules = [
        'required'
    ];

    public $settings = [
        'htmlId',
        'htmlClass'
    ];

}
?>
