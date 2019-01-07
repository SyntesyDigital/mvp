<?php
namespace Modules\RRHH\Traits;

use Modules\RRHH\Entities\CustomerField;

trait FormFieldsEntity
{
    public function fields()
    {
        return $this->hasMany($this->fieldModel);
    }


    public function saveField($key, $value)
    {
        return $this->fields()->save(new CustomerField([
            'name' => $key,
            'value' => $value
        ]));
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


    public function getFieldValue($key)
    {
        return $this->getField($key);
    }

    public static function whereField($name, $value)
    {
        return self::whereHas('fields', function ($q) use ($name, $value) {
            $q->where('name', $name);
            $q->where('value', 'like', $value);
        });
    }


    public function scopeByField(Builder $query, $name, $value, $operator = "=", $boolean = 'and')
    {

        if ($boolean == 'or') {
            return $query->orWhereHas('fields', function ($q) use ($name, $value, $operator, $boolean) {
                $q
                    ->where('name', $name)
                    ->where('value', $operator, $value);
            });
        }

        return $query->whereHas('fields', function ($q) use ($name, $value, $operator, $boolean) {
            $q
                ->where('name', $name)
                ->where('value', $operator, $value);
        });
    }

    public function scopeWhereFields(Builder $query, $arr, $boolean = 'and')
    {
        if(!$arr) {
            return $query;
        }

        if (!is_array($arr[0])) {
            if(sizeof($arr) > 2) {
                return $query->byField($arr[0], $arr[2], $arr[1], $boolean);
            } else {
                return $query->byField($arr[0], "=", $arr[1], $boolean);
            }
        }

        $condition = 'and';
        foreach ($arr as $k => $v) {
            if (is_array($v)) {
                if(sizeof($v) > 2) {
                    $query->byField($v[0],$v[2], $v[1], $condition);
                } else {
                    $query->byField($v[0], "=", $v[1], $condition);
                }
                $condition = 'and';
            } else {
                $condition = strtolower($v);
            }
        }

        return $query;
    }


    public function scopeOrderByField(Builder $query, $column, $mode, $iso = null)
    {
        if(in_array($column, $this->fillable) || $column == "id") {
            return $query->orderBy($column, $mode);
        }

        $columnName = $column . '_order';

        $sql = DB::raw(sprintf('(
            SELECT
                customers_fields.value
            FROM
                customers_fields
            WHERE
                customers_fields.content_id = contents.id
            AND
                customers_fields.name = "%s"
            LIMIT 1
        ) AS %s', $column, $columnName));

        return $query
            ->select('*', $sql)
            ->orderBy($columnName, $mode);
    }

    public function __get($key)
    {
        $value = parent::__get($key);

        return null === $value ? $this->getField($key) : $value;
    }
}
