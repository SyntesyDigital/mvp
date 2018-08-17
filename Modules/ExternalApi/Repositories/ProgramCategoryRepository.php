<?php
/**
 * Created by PhpStorm.
 * User: ninidc
 * Date: 15/08/2018
 * Time: 14:15
 */

namespace Modules\ExternalApi\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

class ProgramCategoryRepository extends BaseRepository
{
    public function model()
    {
        return "Modules\\ExternalApi\\Entities\\ProgramCategory";
    }

    public function getByCode($code)
    {
        return $this->findWhere([
            'code' => $code
        ])->first();
    }

}