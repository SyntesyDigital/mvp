<?php

namespace Modules\Architect\Fields\Rules;

class MaxCharacters
{
    public $name = "maxCharacters";

    public function validate($value, $param)
    {
        $values = !is_array($value) ? [$value] : $value;

        if($param) {
            foreach($values as $k => $value) {
                if(strlen($value) > $param) {
                    return [$k => $this->message()];
                }
            }
        }
    }

    public function message()
    {
        return 'Max reached !';
    }
}
