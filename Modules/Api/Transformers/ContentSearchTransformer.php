<?php

namespace Modules\Api\Transformers;

use Illuminate\Http\Resources\Json\Resource;

use Modules\Architect\Entities\Media;
use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\Typology;
use Modules\Architect\Entities\Language;

// FIXME : move this or find a better way :)
use Modules\Turisme\Adapters\PageBuilderAdapter;

use Modules\Architect\Transformers\TagTransformer;
use Modules\Architect\Transformers\CategoryTransformer;

class ContentSearchTransformer extends Resource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request, $language = null, $data = [])
    {
        return array_merge([
            'id' => $this->resource->id,
            'title' => $this->resource->getTitleAttribute($language),
            'description' => '',
            'url' => $this->resource->getUrlAttribute($language),
        ], $data);
    }


}
