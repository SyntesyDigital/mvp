<?php

namespace Modules\Architect\Transformers;

use Illuminate\Http\Resources\Json\Resource;

use Modules\Architect\Transformers\ContentTransformer;
use Modules\Architect\Ressources\CategoryTreeCollection;

class CategoryTransformer extends Resource
{
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'name' => $this->getFieldValue('name'),
            'slug' => $this->getFieldValue('slug'),
            'description' => $this->getFieldValue('description')
        ];

        if($request->get('loads')) {
            if(in_array('contents', explode(',',$request->get('loads')))) {
                $data['contents'] = $this->contents->map(function($content) use ($request){
                    return (new ContentTransformer($content))->toArray($request);
                })->toArray();
            }

            if(in_array('descendants', explode(',',$request->get('loads')))) {
                $data['descendants'] = $this->descendants->map(function($category) use ($request){
                    return (new self($category))->toArray($request);
                })->toArray();
            }
        }

        return $data;
    }
}
