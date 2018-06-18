<?php

namespace Modules\Architect\Fields\Rules;

class Required
{
    public $name = "required";

    public function validate($value, $param)
    {
        $values = !is_array($value) ? [$value] : $value;
        $errors = [];

        if($param) {
            foreach($values as $k => $value) {
                if(!trim(strip_tags($value))) {
                    $errors[$k] = $this->message();
                }
            }
        }

        return !empty($errors) ? $errors : null;
    }

    public function message()
    {
        return trans('architect::rules.required');
    }
}
