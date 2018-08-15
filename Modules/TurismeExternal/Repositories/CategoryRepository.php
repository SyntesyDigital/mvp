<?php
/**
 * Created by PhpStorm.
 * User: ninidc
 * Date: 15/08/2018
 * Time: 14:15
 */

namespace Modules\TurismeExternal\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

class CategoryRepository extends BaseRepository
{
    public function model()
    {
        return "Modules\\TurismeExternal\\Entities\\Category";
    }

    public function getByCode($code)
    {
        return $this->findWhere([
            'code' => $code
        ])->first();
    }

}