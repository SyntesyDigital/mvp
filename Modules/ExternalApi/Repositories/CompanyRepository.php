<?php
/**
 * Created by PhpStorm.
 * User: ninidc
 * Date: 16/08/2018
 * Time: 19:10
 */

namespace Modules\ExternalApi\Repositories;


use Prettus\Repository\Eloquent\BaseRepository;

class CompanyRepository extends BaseRepository
{

    protected $fieldSearchable = [
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
        'indicators.id_axe',
        'axes.id_axe'
    ];

    public function model()
    {
        return "Modules\\ExternalApi\\Entities\\Company";
    }
}
