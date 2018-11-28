<?php

namespace Modules\RRHH\Entities\Content;

use App\Traits\HasCategories;
use App\Traits\HasContentAttributs;
use Illuminate\Database\Eloquent\Model;
use LaravelLocalization;

class Content extends Model
{
    use HasContentAttributs, HasCategories;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contents';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'typology_id',
        'user_id',
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

    public function typology()
    {
        return $this->hasOne('Modules\RRHH\Entities\Content\Typology', 'id', 'typology_id');
    }

    public function fields()
    {
        return $this->hasMany('Modules\RRHH\Entities\Content\ContentField');
    }

    public function user()
    {
        return $this->hasOne('Modules\RRHH\Entities\User', 'id', 'user_id');
    }

    /**
     * Method used to retrieve the field without the language id, because fields is
     * is filtered previously by scope.
     */
    public function getField($name)
    {
        $attr = $this->fields->where('name', $name);

        if (sizeof($attr) > 0) {
            return $attr->first()->value;
        }

        return null;
    }

    /**
     *   Return a field by name and langauge, if langauge is false, we
     *   we understan language is provided direclty by the content.
     */
    public function field($name, $languageId = false, $decodeJson = false)
    {
        $field = $this->fields->where('name', $name);

        if ($languageId) {
            /*
            $local = LaravelLocalization::getCurrentLocale(); //en
            $language = Language::where("iso", $local)->first();
            $languageId = isset($language->id) ? $language->id : null;
            */
            $field = $field->where('language_id', $languageId);
        }

        return $field->first();
    }

    public function getFieldValue($name, $languageId = false)
    {
        $field = $this->field($name, $languageId);

        return isset($field) ? $field->value : null;
    }

    public static function getContentsByTypology($typology_id, $languageId = false)
    {
        if (! $languageId) {
            $local = LaravelLocalization::getCurrentLocale();
            $language = Language::where('iso', $local)->first();
            $languageId = isset($language->id) ? $language->id : null;
        }

        $contents = self::orderBy('id', 'asc');
        $contents->where('typology_id', $typology_id)->where('status', 1);

        // Load fields
        $contents->with(['fields' => function ($q) use ($languageId) {
            $q->where('language_id', $languageId);
        }]);

        $itemsContent = $contents->get();

        return $itemsContent;
    }

    public static function whereField($name, $value)
    {
        return self::whereHas('fields', function ($q) use ($name, $value) {
            $q->where('name', $name);
            $q->where('value', 'like', $value);
        });
    }

    public function fieldsDefinition()
    {
        if ($this->typology) {
            return json_decode($this->typology->definition);
        }

        return null;
    }

    public static function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

    public function scopeByTypology($query, $id)
    {
        return $query->where('typology_id', $id);
    }

    /*****************************************************************************
    *
    *     New methods to get content, with langauge id included
    *
    ******************************************************************************/

    /**
     *   Get content by typology and filtered by language.
     */
    public static function getFirstContentByTypology($typologyId, $languageId)
    {
        return self::where('status', 1)->with(['fields' => function ($q) use ($languageId) {
            $q->byLanguage($languageId);
        }])->where('typology_id', $typologyId)->first();
    }

    /**
     *   Get content by typology and filtered by language.
     */
    public static function getBySlug($slug, $languageId = null)
    {
        return self::whereField('slug', $slug)
            ->where('status', 1)
            ->with(['fields' => function ($q) use ($languageId) {
                if ($languageId) {
                    $q->byLanguage($languageId);
                }
            }]);
    }

    /**
     *   Get content by id filtered by langauge.
     */
    public static function getById($id, $languageId)
    {
        return self::where('id', $id)->where('status', 1)
        ->with(['fields' => function ($q) use ($languageId) {
            $q->byLanguage($languageId);
        }]);
    }

    /**
     *   Get all contents of a typlogy with language.
     */
    public static function getAllByTypology($typologyId, $languageId)
    {
        return self::where('status', 1)->with(['fields' => function ($q) use ($languageId) {
            $q->byLanguage($languageId);
        }])->where('typology_id', $typologyId);
    }
}
