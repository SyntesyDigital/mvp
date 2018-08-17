<?php
/**
 * Created by PhpStorm.
 * User: ninidc
 * Date: 16/08/2018
 * Time: 19:09
 */

namespace Modules\ExternalApi\Repositories;


use Prettus\Repository\Eloquent\BaseRepository;

class AxeRepository extends BaseRepository
{

    protected $fieldSearchable = [
        'description_ca',
        'description_es',
        'description_en',
    ];

    public function model()
    {
        return "Modules\\ExternalApi\\Entities\\Axe";
    }
}