<?php

namespace Modules\Architect\Fields\Rules;

class Unique
{
    public $name = "unique";

    public function validate($value, $param)
    {

    }

    public function message()
    {
        return trans('architect::rules.unique');
    }
}
