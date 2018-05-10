<?php

namespace Modules\Architect\Fields\Types;

use Modules\Architect\Fields\FieldInterface;

class Images implements FieldInterface
{
    public $type = 'images';

    public function validate(Request $request)
    {}

    public function save(Content $content, Request $request)
    {}
}
?>
