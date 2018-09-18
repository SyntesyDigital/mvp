<?php

namespace Modules\Api\Collections;

use Illuminate\Http\Resources\Json\ResourceCollection;

use Modules\Architect\Transformers\ContentTransformer;
use Modules\Architect\Entities\Language;

use Modules\Api\Transformers\ContentSearchTransformer;

class ContentSearchCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request, $hits = null)
    {
        $language = $request->get('accept_lang') ? Language::byIso($request->get('accept_lang'))->first() : Language::getDefault();

        return [
            'data' => $this->collection->map(function($content) use ($request, $language, $hits){

                $description = null;
                foreach($hits as $hit) {
                    if($hit['_id'] == $content->id) {
                        if($content->is_page) {
                            $description = str_limit(str_before($hit['_source'][$language->iso]['body'], request('q')), 300);
                            $description .= request('q');
                            $description .= str_limit(str_after($hit['_source'][$language->iso]['body'], request('q')), 300);
                        }
                    }
                }

                return (new ContentSearchTransformer($content))
                    ->toArray($request, $language, [
                        'description' => $description
                    ]);
            })
        ];
    }
}
