<?php

namespace Modules\Architect\Fields\Types;

use Modules\Architect\Fields\FieldInterface;

class Text implements FieldInterface
{
    public $type = 'text';

    private $optionalValidationRules = [
        'required',
        'unique',
        'size'
    ];

    public function validate(Request $request)
    {}

    public function save(Content $content, Request $request)
    {}
        
}
?>
