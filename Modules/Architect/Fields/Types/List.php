<?php

namespace Modules\Architect\Fields\Types;

use Modules\Architect\Fields\FieldInterface;

class List implements FieldInterface
{
    public $type = 'list';

    public function validate(Request $request)
    {}

    public function save(Content $content, Request $request)
    {}
}
?>
