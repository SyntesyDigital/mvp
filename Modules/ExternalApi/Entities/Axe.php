<?php

namespace Modules\ExternalApi\Entities;

use Illuminate\Database\Eloquent\Model;

class Axe extends Model
{

    protected $table = 'axes';

    protected $connection= 'turisme_external';

    protected $fillable = [
        'id',
        'id_axe',
        'description_ca',
        'description_es',
        'description_en'
    ];

    public $timestamps = false;


    public function indicators()
    {
        return $this->hasMany('\Modules\ExternalApi\Entities\Indicator', 'id_axe');
    }

    public function companies()
    {
        return $this->hasManyThrough('\Modules\ExternalApi\Entities\Company', '\Modules\ExternalApi\Entities\Indicator', 'id_axe', null, null, 'indicator_id');
    }

}
