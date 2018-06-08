<?php

namespace Modules\Architect\Fields\Rules;

class MinCharacters
{
    public $name = "minCharacters";

    public function validate($value, $param)
    {
        $values = !is_array($value) ? [$value] : $value;

        if($param && $param > 0) {
            foreach($values as $k => $value) {
                if(strlen($value) < $param) {
                    return [$k => $this->message()];
                }
            }
        }
    }

    public function message()
    {
        return 'Min not reached !';
    }
}
