<?php

namespace Modules\Architect\Fields\Types;

use Modules\Architect\Fields\Field;
use Modules\Architect\Fields\FieldInterface;

use Modules\Architect\Entities\Content;

class ContentList extends Field implements FieldInterface
{
    public $type = 'contentlist';
    public $icon = 'fa-th-list';
    public $name = 'LIST';

    public $rules = [
        'required'
    ];

    public $options = [
        'only_typologies'
    ];

    public function validate($request)
    {}

    public function save($content, $identifier, $values, $languages = null)
    {
        return parent::save($content, $identifier, $values, $languages);
    }
}
?>
