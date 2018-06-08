<?php

namespace Modules\Architect\Fields\Types;

use Modules\Architect\Fields\Field;
use Modules\Architect\Fields\FieldInterface;
use Modules\Architect\Entities\Content;

class Image extends Field implements FieldInterface
{
    public $type = 'image';
    public $icon = 'fa-picture-o';
    public $name = 'IMAGE';

    public $rules = [
        'required'
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
