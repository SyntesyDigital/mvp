<?php

namespace Modules\Architect\Fields\Rules;

class Required
{
    public $name = "required";

    public function validate($value, $param)
    {
        $values = !is_array($value) ? [$value] : $value;

        if($param) {
            if(empty(array_filter($values))) {
                return $this->message();
            }
        }
    }

    public function message()
    {
        return 'Empty field !';
    }
}
