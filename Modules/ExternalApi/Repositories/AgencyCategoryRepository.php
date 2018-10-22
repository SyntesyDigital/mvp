<?php
/**
 * Created by PhpStorm.
 * User: ninidc
 * Date: 16/08/2018
 * Time: 19:10
 */

namespace Modules\ExternalApi\Repositories;


use Prettus\Repository\Eloquent\BaseRepository;

class AgencyCategoryRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'id',
        'description_ca',
        'description_es',
        'description_en',
    ];

    public function model()
    {
        return "Modules\\ExternalApi\\Entities\\AgencyCategory";
    }

}
