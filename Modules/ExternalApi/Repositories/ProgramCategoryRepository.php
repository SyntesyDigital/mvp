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

    protected $fieldSearchable = [
        'code',
        'description_ca',
        'description_es',
        'description_en',
        'members.name',
        'members.code',
        'members.email',
        'members.id',
        'programs.code',
    ];

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
