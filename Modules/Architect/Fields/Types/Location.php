<?php

namespace Modules\Architect\Fields\Types;

use Modules\Architect\Fields\FieldInterface;

class Location implements FieldInterface
{
    public $type = 'location';

    public function validate(Request $request)
    {}

    public function save(Content $content, Request $request)
    {}
}
?>
