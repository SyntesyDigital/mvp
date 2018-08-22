<?php

namespace Modules\ExternalApi\Entities;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    protected $connection= 'turisme_external';

    protected $fillable = [
        'id',
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


    public function indicator()
    {
        return $this->hasOne('\Modules\ExternalApi\Entities\Indicator', 'id', 'indicator_id');
    }

    public function axes()
    {
        return $this->belongsToMany('\Modules\ExternalApi\Entities\Axe', 'indicators', 'id');
    }
}
