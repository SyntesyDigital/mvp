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

    protected $fieldSearchable = [
        'code',
        'description_ca',
        'description_es',
        'description_en',
        'members.name',
        'members.code',
        'members.email',
        'members.id',
        'category.code',
        'category.description_ca',
        'category.description_es',
        'category.description_en',
    ];

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
