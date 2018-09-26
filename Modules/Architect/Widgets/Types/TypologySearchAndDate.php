<?php

namespace Modules\Architect\Widgets\Types;

use Modules\Architect\Widgets\Widget;
use Modules\Architect\Widgets\WidgetInterface;

use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\ContentField;
use Modules\Architect\Entities\Language;

class TypologySearchAndDate extends Widget implements WidgetInterface
{
    public $type = 'widget';
    public $icon = 'fa-file-o';
    public $name = 'TYPOLOGY_SEARCH_DATE';
    public $component = 'CommonWidget';

    public $fields = [
    ];

    public $rules = [
        'required'
    ];

    //public $hidden = true;

    public $settings = [
        'htmlId',
        'htmlClass',
        'typology',
        'textIdentifier',
        'dateIdentifier',
        'itemsPerPage',
        'columns'
    ];
}
?>
