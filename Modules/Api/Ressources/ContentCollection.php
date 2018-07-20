<?php

namespace Modules\Api\Ressources;

use Illuminate\Http\Resources\Json\ResourceCollection;

use Modules\Api\Transformers\ContentTransformer;

class ContentCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
     public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($content) use ($request){
                return (new ContentTransformer($content))->toArray($request);
            })
        ];
    }


}
