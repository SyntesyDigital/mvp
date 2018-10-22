<?php

namespace Modules\ExternalApi\Entities;

use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    protected $table = 'indicators';

    protected $connection= 'turisme_external';

    protected $fillable = [
        'id',
        'axe_id',
        'description_ca',
        'description_es',
        'description_en',
    ];

    public $timestamps = false;

    /*
    public function companies()
    {
        return $this->hasMany('\Modules\ExternalApi\Entities\Company');
    }
    */

    public function companies()
    {
        return $this->belongsToMany('Modules\ExternalApi\Entities\Company', 'companies_indicators_pivot', 'indicator_id', 'company_id');
    }

    public function axe()
    {
        return $this->belongsTo('\Modules\ExternalApi\Entities\Axe');
    }
}
