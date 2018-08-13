<?php

namespace Modules\Architect\Transformers;

use Illuminate\Http\Resources\Json\Resource;

use Modules\Architect\Entities\Media;
use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\Typology;
use Modules\Architect\Entities\Language;

// FIXME : move this or find a better way :)
use Modules\Turisme\Adapters\PageBuilderAdapter;

class ContentTransformer extends Resource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $languages = Language::all();

        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'fields' => $this->getFields($languages),
            'is_page' => boolval($this->resource->is_page),
            'page' => $this->resource->is_page ? $this->getPage($languages) : null,
            'typology' => !$this->resource->is_page ? $this->resource->typology->toArray() : null,
            'full_slug' => $this->resource->getFullSlug()
        ];
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
