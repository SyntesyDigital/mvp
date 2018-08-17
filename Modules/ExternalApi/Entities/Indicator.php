<?php

namespace Modules\ExternalApi\Entities;

use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    protected $table = 'indicators';

    protected $connection= 'turisme_external';

    protected $fillable = [
        'id',
        'indicator_id',
        'id_axe',
        'description_ca',
        'description_es',
        'description_en',
    ];

    public $timestamps = false;


    public function companies()
    {
        return $this->hasMany('\Modules\ExternalApi\Entities\Company', 'indicator_id');
    }

    /*
    public function category()
    {
        return $this->hasOne('\Modules\ExternalApi\Entities\ProgramCategory', 'program_id', 'id');
    }
    */
}
