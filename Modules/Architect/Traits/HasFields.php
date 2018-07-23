<?php

namespace Modules\Architect\Traits;

use Modules\Architect\Entities\Media;
use Modules\Architect\Entities\Content;

trait HasFields
{
    public function getFieldChilds($field)
    {
        $arr = [];

        if(!$field) {
            return null;
        }

        foreach($this->fields as $f) {
            if($f->parent_id == $field->id) {
                $arr[] = $f;
            }
        }

        return sizeof($arr) ? collect($arr) : null;
    }

    public function fields()
    {
        return $this->hasMany($this->fieldModel);
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


    public function getFieldByIdentifier($identifier)
    {
        $field = null;
        foreach($this->fields as $f) {
            if($identifier == $f->name) {
                if($field != null) {
                    if(is_array($field)) {
                        $field[] = $f;
                    } else {
                        $field = [$field, $f];
                    }
                } else {
                    $field = $f;
                }
            }
        }

        return $field;
    }


    public function getFieldValues($identifier, $type, $languages)
    {
        $field = $this->getFieldByIdentifier($identifier);

        switch($type) {
            case 'richtext':
            case 'slug':
            case 'text':
                $values = [];
                if(is_array($field)) {
                    return collect($field)->mapWithKeys(function($f) use ($languages) {
                        $iso = null;
                        foreach($languages as $l) {
                            if($f->language_id == $l->id) {
                                $iso = $l->iso;
                            }
                        }

                        return [$iso => $f->value];
                    });
                }
                return isset($field->value) ? $field->value : null;
            break;

            case 'localization':
                return json_decode($field->value, true);
            break;

            case 'images':
            case 'image':
                $field = !is_array($field) ? [$field] : $field;
                return Media::whereIn('id', collect($field)->pluck('value'))->get();
            break;

            case 'contents':
                $field = !is_array($field) ? [$field] : $field;
                return Content::whereIn('id', collect($field)->pluck('value'))->get();
            break;

            case 'url':
            case 'link':
                $values = null;
                $childs = $this->getFieldChilds($field);

                if($childs != null){
                  foreach($childs as $k => $v) {

                      if($v->language_id) {
                          $iso = null;
                          foreach($languages as $l) {
                              if($v->language_id == $l->id) {
                                  $iso = $l->iso;
                              }
                          }

                          $values[ explode('.', $v->name)[1] ][$iso] = $v->value;
                      } else {
                          if(explode('.', $v->name)[1] == 'content') {
                              $values[ explode('.', $v->name)[1] ] = Content::find($v->value);
                          }
                      }
                  }
                }

                return $values;
            break;

            case 'video':
                $values = null;
                $childs = $this->getFieldChilds($field);

                if($childs != null){
                  foreach($childs as $k => $v) {
                      if($v->language_id) {

                          $iso = null;
                          foreach($languages as $l) {
                              if($v->language_id == $l->id) {
                                  $iso = $l->iso;
                              }
                          }

                          $values[ explode('.', $v->name)[1] ][$iso] = $v->value;
                      }
                  }
                }

                return $values;
            break;

            default:
                $values = [];
                if(is_array($field)) {
                    return collect($field)->mapWithKeys(function($f) use ($languages) {
                        $iso = null;
                        foreach($languages as $l) {
                            if($f->language_id == $l->id) {
                                $iso = $l->iso;
                            }
                        }

                        return [$iso => $f->value];
                    });
                }
                return $field->value;
            break;
        }
    }
}
