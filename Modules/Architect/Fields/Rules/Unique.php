<?php

namespace Modules\Architect\Fields\Rules;


use Modules\Architect\Entities\Content;

class Unique
{
    public $name = "unique";

    public function validate($value, $param)
    {
        $values = !is_array($value) ? [$value] : $value;
        $errors = [];

        if($param) {
            foreach($values as $k => $value) {
                $isUpdate = request()->get('content_id') ? true : false;
                if($isUpdate) {
                    if(Content::whereField('slug', $value)->where('id', '<>', request()->get('content_id'))->count() > 1) {
                        $errors[$k] = $this->message();
                    }
                } else {
                    if(Content::whereField('slug', $value)->count() > 0) {
                        $errors[$k] = $this->message();
                    }
                }
            }
        }

        return !empty($errors) ? $errors : null;
    }

    public function message()
    {
        return trans('architect::rules.unique');
    }
}
