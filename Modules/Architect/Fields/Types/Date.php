<?php

namespace Modules\Architect\Fields\Types;

use Modules\Architect\Fields\Field;
use Modules\Architect\Fields\FieldInterface;
use Modules\Architect\Entities\Content;

class Date extends Field implements FieldInterface
{
    public $type = 'date';
    public $icon = 'fa-calendar';
    public $name = 'DATE';

    public $rules = [
        'required'
    ];

    public $options = [];

    public function validate($request)
    {}

    public function save($content, $identifier, $values, $languages = null)
    {
        return parent::save($content, $identifier, $values, $languages);
    }
}
?>
