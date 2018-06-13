<?php

namespace Modules\Architect\Traits;

use Modules\Architect\Entities\Media;

trait HasFields
{

    public function loadFields()
    {
        parent::load('fields');

        // FIXME : Optimize ;)
        foreach($this->typology->fields as $field) {
            foreach($this->fields as $k => $f) {

                if($field->identifier == $f->name) {
                    switch($field->type) {
                        case "image":
                            $this->fields[$k]->value = Media::find($f->value);
                        break;

                        case "images":
                            $this->fields[$k]->value = Media::whereIn('id', json_decode($f->value))->get();
                        break;
                    }
                }
            }
        }
    }


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
