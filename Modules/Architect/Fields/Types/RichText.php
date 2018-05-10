<?php

namespace Modules\Architect\Fields\Types;

use Modules\Architect\Fields\FieldInterface;

class RichText implements FieldInterface
{
    public $type = 'richtext';

    public function validate(Request $request)
    {}

    public function save(Content $content, Request $request)
    {}
}
?>
