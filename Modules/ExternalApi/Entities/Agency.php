<?php

namespace Modules\ExternalApi\Entities;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    protected $table = 'agencies';

    protected $primaryKey = 'id';

    protected $connection= 'turisme_external';

    protected $fillable = [
        'id',
        'name',
        'address',
        'postcode',
        'city',
        'country',
        'phone_number',
        'fax_number',
        'email',
        'web',
        'BCB_member',
        'receptive',
        'incentive',
        'congresses',
        'validated'
    ];

    public $timestamps = false;


    public function categories()
    {
        return $this->belongsToMany('Modules\ExternalApi\Entities\AgencyCategory', 'agencies_categories_pivot', 'agency_id', 'category_id');
    }
}
