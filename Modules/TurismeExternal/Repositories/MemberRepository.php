<?php
/**
 * Created by PhpStorm.
 * User: ninidc
 * Date: 15/08/2018
 * Time: 13:36
 */

namespace Modules\TurismeExternal\Repositories;

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
        'email'
    ];

    public function boot(){
        //$this->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
    }


    public function model()
    {
        return "Modules\\TurismeExternal\\Entities\\Member";
    }
}