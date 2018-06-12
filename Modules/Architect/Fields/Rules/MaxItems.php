<?php

namespace Modules\Architect\Fields\Rules;

class MaxItems
{
    public $name = "maxItems";

    public function validate($value, $param)
    {

    }

    public function message()
    {
        return 'max items !';
    }
}
