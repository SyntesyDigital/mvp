<?php

namespace Modules\RRHH\Entities\Content;

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
        'id',
        'name',
        'identifier',
        'definition',
        'customizable',
        'display_menu',
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

    public function contents()
    {
        return $this->hasMany('Modules\RRHH\Entities\Content\Content');
    }

    public function categories()
    {
        return $this->hasMany('Modules\RRHH\Entities\Content\Category', 'typology_id', 'id');
    }

    public function getField($fieldName)
    {
        $json = json_decode($this->definition, true);

        if (is_array($json)) {
            foreach ($json as $key => $value) {
                $name = isset($value['name']) ? $value['name'] : null;

                if ($fieldName == $name) {
                    return json_decode(json_encode($value), false);
                }
            }
        }
    }

    public function addField($name, $type, $options = [])
    {
        if (false == $this->customizable) {
            return false;
        }

        if ($this->definition) {
            $fields = json_decode($this->definition);
        } else {
            $fields = [];
        }

        $field = [
            'name' => $name,
            'type' => $type,
            'label' => ucfirst($name),
        ];

        array_push($fields, array_merge($field, $options));

        $this->definition = json_encode($fields);

        if ($this->save()) {
            return true;
        }

        return false;
    }

    public function generateFieldName($type)
    {
        $fields = json_decode($this->definition);
        $count = 1;

        if (! empty($fields)) {
            foreach ($fields as $f) {
                if ($type == $f->type) {
                    ++$count;
                }
            }
        }

        return $type.'_'.$count;
    }

    public function getDefinition()
    {
        return json_decode($this->definition);
    }

    public function scopeByIdentifier($query, $tag)
    {
        return $query->where('identifier', $tag);
    }
}
