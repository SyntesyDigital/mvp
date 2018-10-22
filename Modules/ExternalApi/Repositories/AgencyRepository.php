<?php
/**
 * Created by PhpStorm.
 * User: ninidc
 * Date: 16/08/2018
 * Time: 19:10
 */

namespace Modules\ExternalApi\Repositories;


use Prettus\Repository\Eloquent\BaseRepository;

class AgencyRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'id',
        'name',
        'address',
        'postcode',
        'city',
        'country',
        'phone_number',
        'fax_number',
        'email',
        'web',
        'BCB_member',
        'receptive',
        'incentive',
        'congresses',
        'validated',
        'categories.name',
        'categories.id'
    ];

    public function model()
    {
        return "Modules\\ExternalApi\\Entities\\Agency";
    }
}
