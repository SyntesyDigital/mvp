<?php

namespace Modules\Architect\Fields\Rules;

class Required
{
    public $name = "required";

    public function validate($value, $param, $identifier)
    {
        $values = !is_array($value) ? [$value] : $value;
        $errors = [];

        if($param) {
            if(empty($values)) {
                $errors[] = $this->message();
            }

            foreach($values as $k => $value) {
                //FIXME if(!trim(strip_tags($value))) {
                if(!trim($value)) {
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
