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
    public $component = 'CommonWidget';

    public $fields = [
        [
            "class" => 'Modules\Architect\Fields\Types\Text',
            "identifier" => "title",
            "type" => "text", // <= FIXME : ex : Text::getType()
            "name" => "Títol", // <= FIXME : translate it!
        ],
        [
            "class" => 'Modules\Architect\Fields\Types\Text',
            "identifier" => "slug",
            "type" => "text", // <= FIXME
            "name" => "Slug" // <= FIXME : translate it!
        ],
        [
            "class" => 'Modules\Architect\Fields\Types\Link',
            "identifier" => "link",
            "type" => "link", // <= FIXME
            "name" => "Link" // <= FIXME : translate it!
        ],
    ];

    public $rules = [
        'required'
    ];

    public $settings = [
        'htmlId',
        'htmlClass',
        'allowedTypologies'
    ];


    // public function save($content, $identifier, $fields)
    // {
    //     foreach($fields as $field) {
    //         foreach($field['fields'] as $k => $f) {
    //             $fieldName = $identifier . "_" . $k . "_" . $f['identifier'];
    //             $fieldValue = isset($f['value']) ? $f['value'] : null;
    //             (new $f['class'])->save($content, $fieldName, $fieldValue);
    //         }
    //     }
    //
    //     return true;
    // }

}
?>
