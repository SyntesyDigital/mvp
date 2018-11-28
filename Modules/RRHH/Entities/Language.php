<?php

namespace Modules\RRHH\Entities;

use Illuminate\Database\Eloquent\Model;

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

    public function translates()
    {
        return $this->hasMany('Modules\RRHH\Entities\Translate');
    }

    public function getTranslateValue($key)
    {
        $translate = $this->translates->where('name', $key)->first();

        return isset($translate->value) ? $translate->value : null;
    }
}
