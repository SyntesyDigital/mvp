<?php

namespace Modules\Architect\Jobs\Content;

use Modules\Architect\Http\Requests\Content\CreateContentRequest;
use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\ContentField;
use Modules\Architect\Fields\FieldConfig;
use Modules\Architect\Entities\Language;

class UpdateContent
{
     public function __construct(Content $content, $attributes)
     {
         $this->content = $content;
         $this->attributes = array_only($attributes, [
             'status',
             'typology_id',
             'author_id',
             'fields'
         ]);
     }

    public static function fromRequest(Content $content, CreateContentRequest $request)
    {
        return new self($content, $request->all());
    }

    // Optimize this !!!
    public function getFieldObject($type, $fieldObjects)
    {
        foreach($fieldObjects as $f) {
            if($type == $f["type"]) {
                return new $f['class'];
            }
        }

        return null;
    }

    // FIXME : change the name :)
    public function saveTypologyContent(Content $content)
    {
        $fieldObjects = FieldConfig::get();
        $languages = Language::all();
        $content->fields()->delete();

        foreach($this->attributes["fields"] as $field) {
            $values = isset($field["values"]) ? $field["values"] : null;
            $identifier = isset($field["identifier"]) ? $field["identifier"] : null;
            $type = isset($field["type"]) ? $field["type"] : null;

            if($values && $type && $identifier) {
                $this
                    ->getFieldObject($type, $fieldObjects) // <= Better into FieldObject like FieldHandler ?
                    ->save($content, $identifier, $values, $languages);
            }
        }
    }

    public function handle()
    {
        $this->content->update([
            'status' => $this->attributes['status'] ? $this->attributes['status'] : 0,
            'author_id' => $this->attributes['author_id'],
        ]);

        // IF content with typology
        if($this->content->typology_id) {
            $this->saveTypologyContent($this->content);
        }

        return $this->content;
    }
}
