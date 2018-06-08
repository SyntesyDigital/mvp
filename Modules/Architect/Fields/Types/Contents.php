<?php

namespace Modules\Architect\Fields\Types;

use Modules\Architect\Fields\Field;
use Modules\Architect\Fields\FieldInterface;
use Modules\Architect\Entities\Content;

class Contents extends Field implements FieldInterface
{
    public $type = 'contents';
    public $icon = 'fa-file-o';
    public $name = 'CONTENTS';

    public $rules = [
        'required',
        'maxItems',
        'minItems'
    ];

    public $settings = [
        'typologiesAllowed'
    ];

    public function validate($request)
    {}

    public function save($content, $identifier, $values, $languages = null)
    {
        return parent::save($content, $identifier, $values, $languages);
    }
}
?>
