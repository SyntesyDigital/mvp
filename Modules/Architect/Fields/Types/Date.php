<?php

namespace Modules\Architect\Fields\Types;

use Modules\Architect\Fields\FieldInterface;

class Date implements FieldInterface
{
    public $type = 'date';

    public function validate(Request $request)
    {}

    public function save(Content $content, Request $request)
    {}
}
?>
