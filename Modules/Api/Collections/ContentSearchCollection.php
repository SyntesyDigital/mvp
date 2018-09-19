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
        $self = $this;

        return [
            'data' => $this->collection->map(function($content) use ($request, $language, $hits, $self){

                $hit = null;
                foreach($hits as $h) {
                    if($h['_id'] == $content->id) {
                        $hit = $h;
                    }
                }

                return (new ContentSearchTransformer($content))
                    ->toArray($request, $language, [
                        'description' => $self->buildDescription($hit, $content, $language)
                    ]);
            })
        ];
    }

    private function buildDescription($hit, $content, $language)
    {
        $description = null;

        if($content->is_page) {
            if(isset($hit['_source'][$language->iso]['body'])) {
                $description = str_limit(str_before($hit['_source'][$language->iso]['body'], request('q')), 300);
                $description .= request('q');
                $description .= str_limit(str_after($hit['_source'][$language->iso]['body'], request('q')), 300);
            }

        } else {
            $arr = [];
            $fields = isset($hit['_source'][$language->iso]) ? $hit['_source'][$language->iso] : [];
            foreach($fields as $k => $v) {
                if(trim($v)) {
                    $arr[] = $v;
                }
            }

            $description = str_limit(str_before(implode(' ', $arr), request('q')), 300);
            $description .= request('q');
            $description .= str_limit(str_after(implode(' ', $arr), request('q')), 300);
        }

        return str_replace(request('q'), '<strong>'.request('q').'</strong>', $description);
    }

}
