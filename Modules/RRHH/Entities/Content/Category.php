<?php

namespace Modules\RRHH\Entities\Content;

use Modules\RRHH\Entities\Language;
use Illuminate\Database\Eloquent\Model;

//use LaravelLocalization;

class Category extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'identifier',
        'parent_id',
        'typology_id',
    ];

    /**
     * The attributes that are hidden from serialization.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function fields()
    {
        return $this->hasMany('Modules\RRHH\Entities\Content\CategoryField');
    }

    public function parent()
    {
        return $this->hasOne('Modules\RRHH\Entities\Content\Category', 'id', 'parent_id');
    }

    public function childs()
    {
        return $this->hasMany('Modules\RRHH\Entities\Content\Category', 'parent_id', 'id');
    }

    public function getField($name)
    {
        $attr = $this->fields->where('name', $name);

        if (sizeof($attr) > 0) {
            return $attr->first()->value;
        }

        return null;
    }

    public function field($name, $languageId = false, $decodeJson = false)
    {
        if (! $languageId) {
            //$local = LaravelLocalization::getCurrentLocale();
            $local = 'fr';
            $language = Language::where('iso', $local)->first();
            $languageId = isset($language->id) ? $language->id : null;
        }

        if ($languageId) {
            $field = $this->fields
                        ->where('name', $name)
                        ->where('language_id', $languageId)
                        ->first();

            // FIX SERVER :(
            if (! $field) {
                $field = $this->fields
                            ->where('name', $name)
                            ->where('language_id', "$languageId")
                            ->first();
            }
        } else {
            $field = $this->fields->where('name', $name)->first();
        }

        return $field;
    }

    public function getFieldValue($name, $languageId = null)
    {
        if (! $languageId) {
            //$local = LaravelLocalization::getCurrentLocale();
            $local = 'fr';
            $language = Language::where('iso', $local)->first();
            $languageId = isset($language->id) ? $language->id : null;
        }

        if (! $languageId) {
            $language = Language::first();
            $languageId = isset($language->id) ? $language->id : null;
        }

        $field = $this->field($name, $languageId);

        return isset($field) ? $field->value : null;
    }

    public function saveFields($fields, $languageId)
    {
        foreach ($fields as $name => $value) {
            $this->saveField($name, $value, $languageId);
        }
    }

    public function saveField($name, $value, $languageId = null)
    {
        $field = $this->field($name, $languageId);

        if (! $field) {
            $field = new CategoryField([
                'name' => $name,
            ]);
        }

        $field->category_id = $this->id;
        $field->language_id = $languageId;
        $field->value = $value;

        if (is_array($field->value)) {
            $field->value = json_encode($field->value);
        }

        if ($field->save()) {
            return $field;
        }

        return false;
    }

    public static function whereField($name, $value)
    {
        return self::whereHas('fields', function ($q) use ($name, $value) {
            $q->where('name', $name);
            $q->where('value', 'like', $value);
        });
    }

    public static function getByIdentifier($identifier)
    {
        return self::where('identifier', $identifier)->first();
    }

    public static function getBySlug($slug, $languageId = null)
    {
        return self::whereField('slug', $slug)
            ->where('status', 1)
            ->with(['fields' => function ($q) use ($languageId) {
                if ($languageId) {
                    $q->byLanguage($languageId);
                }
            }])->first();
    }

    /*
    *   Return content from category ID
    */
    public function contents()
    {
        $id = $this->id;

        return Content::whereHas('attrs', function ($q) use ($id) {
            $q->where('name', 'category');
            $q->where('value', $id);
        });
    }

    public function __get($key)
    {
        $_value = parent::__get($key);

        if ($_value) {
            return $_value;
        }

        return $this->getField($key);
    }
}
