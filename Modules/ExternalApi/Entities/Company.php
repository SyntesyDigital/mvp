<?php

namespace Modules\ExternalApi\Entities;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'entities';

    protected $connection= 'turisme_external';

    protected $fillable = [
        'id',
        'company_id',
        'indicator_id',
        'name',
        'description_ca',
        'description_es',
        'description_en',
        'address',
        'postcode',
        'web',
    ];

    public $timestamps = false;


    public function indicators()
    {
        return $this->hasMany('\Modules\ExternalApi\Entities\Indicator', 'indicator_id');
    }

    public function axes()
    {
        return $this->belongsToMany('\Modules\ExternalApi\Entities\Axe', 'indicators', 'id_axe', 'id_axe');
    }
}
