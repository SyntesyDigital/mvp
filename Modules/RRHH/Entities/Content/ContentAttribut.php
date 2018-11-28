<?php

namespace Modules\RRHH\Entities\Content;

use Illuminate\Database\Eloquent\Model;

class ContentAttribut extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contents_attributs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'value',
        'content_id',
    ];

    public $timestamps = false;

    public function content()
    {
        return $this->belongsTo('Modules\RRHH\Entities\Content\Content');
    }
}
