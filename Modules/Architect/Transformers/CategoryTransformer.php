<?php

namespace Modules\Architect\Transformers;

use Illuminate\Http\Resources\Json\Resource;

use Modules\Architect\Transformers\ContentTransformer;

class CategoryTransformer extends Resource
{
    public function toArray($request)
    {
        $data = [
            'name' => $this->getFieldValue('name'),
            'slug' => $this->getFieldValue('slug'),
            'description' => $this->getFieldValue('description'),
        ];

        if($request->get('loads')) {
            if(in_array('contents', explode(',',$request->get('loads')))) {
                $data['contents'] = $this->contents->map(function($content) use ($request){
                    return (new ContentTransformer($content))->toArray($request);
                });
            }
        }

        return $data;
    }
}
