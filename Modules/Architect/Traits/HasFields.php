<?php

namespace Modules\Architect\Traits;

trait HasFields
{
    public function fields()
    {
        return $this->hasMany('Modules\Architect\Entities\ContentField');
    }

    public function getField($name)
    {
        $attr = $this->fields->where('name', $name)->first();

        return $attr ? $attr->value : null;
    }

    public function field($name, $languageId = false, $decodeJson = false)
    {
        $field = $this->fields->where('name', $name);

        if ($languageId) {
            $field = $field->where('language_id', $languageId);
        }

        return $field->first();
    }

    public function getFieldValue($name, $languageId = false)
    {
        $field = $this->field($name, $languageId);

        return isset($field) ? $field->value : null;
    }

    public static function whereField($name, $value)
    {
        return self::whereHas('fields', function ($q) use ($name, $value) {
            $q->where('name', $name);
            $q->where('value', $value);
        });
    }
}
