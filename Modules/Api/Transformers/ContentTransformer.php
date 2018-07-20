<?php

namespace Modules\Api\Transformers;

use Illuminate\Http\Resources\Json\Resource;

use Modules\Architect\Entities\Media;
use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\Typology;
use Modules\Architect\Entities\Language;

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
        $content = $this->resource;
        return [
            'id' => $content->id,
            'title' => $content->title,
            'fields' => $this->getFields(Language::all())
        ];
    }

    private function getFields($languages)
    {
        if(!$this->resource->fields || !$this->resource->typology) {
            return null;
        }

        $fields = [];
        foreach($this->resource->typology->fields as $field) {
            $fields[$field->identifier] = $this->resource->getFieldValues(
                $field->identifier,
                $field->type,
                $languages
            );
        }

        return $fields;
    }

}
