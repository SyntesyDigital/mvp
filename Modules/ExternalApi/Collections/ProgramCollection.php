<?php
/**
 * Created by PhpStorm.
 * User: ninidc
 * Date: 15/08/2018
 * Time: 14:17
 */

namespace Modules\ExternalApi\Collections;


use Illuminate\Http\Resources\Json\ResourceCollection;

class ProgramCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return parent::toArray($request); // TODO: Change the autogenerated stub
    }
}