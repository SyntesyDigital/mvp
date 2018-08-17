<?php
/**
 * Created by PhpStorm.
 * User: ninidc
 * Date: 15/08/2018
 * Time: 14:14
 */

namespace Modules\ExternalApi\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

class ProgramRepository extends BaseRepository
{
    public function model()
    {
        return "Modules\\ExternalApi\\Entities\\Program";
    }

    public function getByCode($code)
    {
        return $this->findWhere([
            'code' => $code
        ])->first();
    }
}