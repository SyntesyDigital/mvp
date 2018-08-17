<?php
/**
 * Created by PhpStorm.
 * User: ninidc
 * Date: 15/08/2018
 * Time: 13:24
 */

namespace Modules\ExternalApi\Transformers;

use Illuminate\Http\Resources\Json\Resource;


class MemberTransformer extends Resource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [];
    }

}