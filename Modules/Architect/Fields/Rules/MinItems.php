<?php

namespace Modules\Architect\Fields\Rules;

class MinItems
{
    public $name = "minItems";

    public function validate($value, $param)
    {
    
    }

    public function message()
    {
        return 'Empty field !';
    }
}
