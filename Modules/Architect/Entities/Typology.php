<?php

namespace Modules\Architect\Entities;

use Illuminate\Database\Eloquent\Model;

class Typology extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'typologies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'icon',
        'identifier',
        // 'is_page',
        // 'display_pagebuilder'
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


    public function contents()
    {
        return $this->hasMany('\Modules\Architect\Entities\Content');
    }

    public function fields()
    {
        return $this->hasMany('\Modules\Architect\Entities\Field');
    }

    public function getIndexField()
    {
        foreach($this->fields as $field) {
            $entryTitle = isset($field->settings["entryTitle"]) ? $field->settings["entryTitle"] : null;

            if($entryTitle === true) {
                return $field->identifier;
            }
        }
        return null;
    }

}
