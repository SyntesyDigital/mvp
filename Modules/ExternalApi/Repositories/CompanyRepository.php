<?php

namespace Modules\ExternalApi\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

class CompanyRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'id',
        'indicator_id',
        'name',
        'description_ca',
        'description_es',
        'description_en',
        'address',
        'postcode',
        'web',
        'indicator.id',
        'indicator.axe_id',
        'axes.id'
    ];

    public function model()
    {
        return "Modules\\ExternalApi\\Entities\\Company";
    }
}
