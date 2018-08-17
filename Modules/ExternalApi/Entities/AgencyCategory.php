<?php

namespace Modules\ExternalApi\Entities;

use Illuminate\Database\Eloquent\Model;

class AgencyCategory extends Model
{

    protected $table = 'agencies_categories';

    protected $connection= 'turisme_external';

    protected $fillable = [
        'name',
        'description_ca',
        'description_es',
        'description_en',
    ];

    public $timestamps = false;

    public function agencies()
    {
        return $this->belongsToMany('Modules\ExternalApi\Entities\Agency', 'agencies_categories_pivot', 'category_id', 'agency_id');
    }
}
