<?php

namespace Modules\Architect\Transformers;

use Illuminate\Http\Resources\Json\Resource;

use Modules\Architect\Entities\Media;
use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\Typology;
use Modules\Architect\Entities\Language;

// FIXME : move this or find a better way :)
use Modules\Turisme\Adapters\PageBuilderAdapter;

use Modules\Architect\Transformers\TagTransformer;
use Modules\Architect\Transformers\CategoryTransformer;

class ContentTransformer extends Resource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request, $language = null)
    {
        // FIXME : find a better way
        $languages = Language::all();

        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'fields' => $this->getFields($languages),
            'is_page' => boolval($this->resource->is_page),
            'page' => $this->resource->is_page ? $this->getPage($languages) : null,
            'typology' => !$this->resource->is_page ? $this->resource->typology->toArray() : null,
            'full_slug' => $this->resource->getFullSlug(),
            'tags' => $this->resource->tags->map(function($tag) use ($request, $language){
                return (new TagTransformer($tag))->toArray($request, $language);
            }),
            'category' => $this->resource->categories->map(function($category) use ($request, $language){
                return (new CategoryTransformer($category))->toArray($request, $language);
            })->first()
        ];

        // $this->resource->tags ? (new TagCollection($this->resource->tags))->toArray() : null
    }

    private function getFields($languages)
    {
        if(!$this->resource->fields) {
            return null;
        }

        $fields = [];
        if($this->resource->typology) {
            foreach($this->resource->typology->fields as $field) {
                $field->values = $this->resource->getFieldValues(
                    $field->identifier,
                    $field->type,
                    $languages
                );
                $fields[$field->identifier] = $field->toArray();
            }
        } else {
            $fields['title'] = $this->resource->getFieldValues(
                'title',
                'text',
                $languages
            );

            $fields['slug'] = $this->resource->getFieldValues(
                'slug',
                'text',
                $languages
            );
        }


        return $fields;
    }

    private function getPage($languages)
    {
        return (new PageBuilderAdapter($this->resource, $languages))->get();
    }

}
