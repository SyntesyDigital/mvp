<?php
/**
 * Created by PhpStorm.
 * User: ninidc
 * Date: 16/08/2018
 * Time: 19:09
 */

namespace Modules\ExternalApi\Repositories;


use Prettus\Repository\Eloquent\BaseRepository;

class IndicatorRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'id',
        'axe_id',
        'description_ca',
        'description_es',
        'description_en',
        'axe.id'
    ];

    public function model()
    {
        return "Modules\\ExternalApi\\Entities\\Indicator";
    }
}
