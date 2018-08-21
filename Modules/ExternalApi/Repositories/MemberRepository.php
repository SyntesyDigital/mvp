<?php
/**
 * Created by PhpStorm.
 * User: ninidc
 * Date: 15/08/2018
 * Time: 13:36
 */

namespace Modules\ExternalApi\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

class MemberRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'code',
        'name',
        'address',
        'postcode',
        'city',
        'phone_number',
        'email',
        'programs.id',
        'programs.code',
        'categories.id',
        'categories.code'
    ];


    public function model()
    {
        return "Modules\\ExternalApi\\Entities\\Member";
    }
}
