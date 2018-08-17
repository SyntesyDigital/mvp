<?php
/**
 * Created by PhpStorm.
 * User: ninidc
 * Date: 16/08/2018
 * Time: 19:43
 */

namespace Modules\ExternalApi\Collections;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CompanyCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}