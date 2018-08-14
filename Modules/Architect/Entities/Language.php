<?php

namespace Modules\Architect\Entities;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Builder;

class Language extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'languages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'iso',
        'default'
    ];

    /**
     * The attributes that are hidden from serialization.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function typology()
    {
        return $this->hasOne('\Modules\Architect\Entities\Typology', "id", "typology_id");
    }


    public static function getDefault()
    {
        $language = cache('defaultLanguage');

        if(!$language) {
            $language = self::where('default', 1)->first();

            cache([
                'defaultLanguage' => $language
            ], now()->addSeconds(180));
        }

        return $language;
    }


    /*
     *  Scopes
     */
    public function scopeByIso(Builder $query, $iso)
    {
        return $query->where('iso', $iso);
    }

}
