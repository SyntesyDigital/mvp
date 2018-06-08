<?php

namespace Modules\Architect\Fields\Types;

use Modules\Architect\Fields\Field;
use Modules\Architect\Fields\FieldInterface;
use Modules\Architect\Entities\Content;

class Link extends Field implements FieldInterface
{
    public $type = 'link';
    public $icon = 'fa-link';
    public $name = 'LINK';

    public $rules = [
        'required'
    ];

    public $settings = [];

    public function validate($request)
    {}

    public function save($content, $identifier, $values, $languages = null)
    {
        return parent::save($content, $identifier, $values, $languages);
    }

}
?>
