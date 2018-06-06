<?php

namespace Modules\Architect\Rules;

use Illuminate\Contracts\Validation\Rule;


class ContentField implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->errors = [];
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        foreach($value as $k => $v) {

            $rules = isset($v["rules"]) ? $v["rules"] : null;
            $values = isset($v['values']) ? $v['values'] : null;

            if(is_array($rules)) {
                foreach($rules as $rule => $ruleValue) {
                    switch($rule) {
                        case 'required':
                            $isValid = is_array($values) ? !empty(array_filter($values)) : !empty($values);

                            if(!$isValid) {
                                $this->errors[] = [
                                    'identifier' => $v['identifier'],
                                    'message' => 'is not good !'
                                ];
                            }
                        break;

                        case 'maxCharacters':
                            if(is_array($values)) {
                                foreach($values as $k2 => $v2) {
                                    if(strlen($values) > $ruleValue) {
                                        $this->errors[] = [
                                            'identifier' => $v['identifier'],
                                            'message' => 'to much !'
                                        ];
                                    }
                                }
                            } else {
                                if(strlen($values) > $ruleValue) {
                                    $this->errors[] = [
                                        'identifier' => $v['identifier'],
                                        'message' => 'to much !'
                                    ];
                                }
                            }
                        break;
                    }
                }
            }
        }

        return empty($this->errors) ? true : false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->errors;
    }
}
