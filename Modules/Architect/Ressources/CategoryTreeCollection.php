<?php

namespace Modules\Architect\Ressources;

use Illuminate\Http\Resources\Json\ResourceCollection;

use Modules\Architect\Transformers\CategoryTransformer;

class CategoryTreeCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
     public function toArray($request)
    {
        $traverse = function ($categories) use (&$traverse, $request) {
            foreach ($categories as $category) {
                $traverse($category->descendants);
                return (new CategoryTransformer($category))->toArray($request);
            }
        };

        return [
            'data' => $traverse($this->collection)
        ];
    }


}
