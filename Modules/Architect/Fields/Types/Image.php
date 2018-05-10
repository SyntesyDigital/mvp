<?php

namespace Modules\Architect\Fields\Types;

use Modules\Architect\Fields\FieldInterface;

class Image implements FieldInterface
{
    public $type = 'image';

    public function validate(Request $request)
    {}

    public function save(Content $content, Request $request)
    {}
}
?>
