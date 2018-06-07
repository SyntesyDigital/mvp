<?php

namespace Modules\Architect\Fields\Types;

use Modules\Architect\Fields\Field;
use Modules\Architect\Fields\FieldInterface;
use Modules\Architect\Entities\Content;

class Images extends Field implements FieldInterface
{
    public $type = 'images';
    public $icon = 'fa-picture-o';
    public $name = 'IMAGES';

    public $rules = [
        'required',
        'maxItems',
        'minItems'
    ];

    public $settings = [
        'cropsAllowed'
    ];

    public function validate($request)
    {}

    public function save($content, $identifier, $values, $languages = null)
    {
        return parent::save($content, $identifier, $values, $languages);
    }
}
?>
