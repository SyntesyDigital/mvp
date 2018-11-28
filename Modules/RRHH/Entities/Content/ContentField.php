<?php

namespace Modules\RRHH\Entities\Content;

use Illuminate\Database\Eloquent\Model;

class ContentField extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contents_fields';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'value',
        'content_id',
        'language_id',
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

    public function content()
    {
        return $this->belongsTo('Modules\RRHH\Entities\Content\Content');
    }

    public function getValueFromJson($name)
    {
        $json = json_decode($this->value);

        return isset($json->$name) ? $json->$name : null;
    }

    public function getValueFromArray($index)
    {
        $json = json_decode($this->value);

        return isset($json[$index]) ? $json[$index] : null;
    }

    public function getJsonValue($name)
    {
        return $this->getValueFromJson($name);
    }

    public function scopeByLanguage($query, $languageId)
    {
        return $query->where('language_id', $languageId);
    }
}
