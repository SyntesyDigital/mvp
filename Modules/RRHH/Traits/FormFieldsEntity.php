<?php
namespace Modules\RRHH\Traits;

trait FormFieldsEntity
{
    public function fields()
    {
        return $this->hasMany($this->fieldModel);
    }

    public function getField($key)
    {
        $attr = $this->fields->where('name', $key);

        if ($attr->count() > 1) {
            return $attr->map(function ($field, $key) {
                return $field->value;
            })->toArray();
        }

        return isset($attr->first()->value) ? $attr->first()->value : null;
    }

    public static function whereField($name, $value)
    {
        return self::whereHas('fields', function ($q) use ($name, $value) {
            $q->where('name', $name);
            $q->where('value', 'like', $value);
        });
    }

    public function __get($key)
    {
        $value = parent::__get($key);

        return null === $value ? $this->getField($key) : $value;
    }
}
