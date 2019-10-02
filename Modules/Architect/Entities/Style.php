<?php

namespace Modules\Architect\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Architect\Traits\HasFields;
use Kalnoy\Nestedset\NodeTrait;

class Style extends Model
{
    use HasFields, NodeTrait;

    protected $fieldModel = 'Modules\Architect\Entities\StyleField';

    protected $table = 'styles';

    protected $appends = ['name'];

    protected $fillable = [
        'identifier',
        'icon'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];


    public function getNameAttribute()
    {
        if($this->fields) {
            foreach($this->fields as $field) {
                if($field->name == 'name') {
                    return $this->getFieldValue($field->name);
                }
            }
        }

        return null;
    }

}
