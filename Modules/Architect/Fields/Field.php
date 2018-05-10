<?php

namespace Modules\Architect\Fields;

use Modules\Architect\Fields\FieldInterface;

class Field implements FieldInterface
{
    private $type;
    private $rules;
    private $identifier;
    private $name;
    private $settings;

    public function validate(Request $request)
    {

    }

    public function save(Content $content, Request $request)
    {}
}
?>
