<?php

namespace Modules\Architect\Jobs\Content;

use Modules\Architect\Http\Requests\Content\CreateContentRequest;
use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\ContentField;
use Modules\Architect\Entities\Language;
use Modules\Architect\Fields\FieldConfig;

class CreateContent
{

    public function __construct($attributes)
    {
        $this->attributes = array_only($attributes, [
            'status',
            'typology_id',
            'author_id',
            'fields',
            'category_id'
            'tags'
        ]);
    }

    public static function fromRequest(CreateContentRequest $request)
    {
        return new self($request->all());
    }


    public function getFieldObject($type, $fieldObjects)
    {
        foreach($fieldObjects as $f) {
            if($type == $f["type"]) {
                return new $f['class'];
            }
        }

        return null;
    }


    public function saveTypologyContent(Content $content)
    {
        $fieldObjects = FieldConfig::get();
        $languages = Language::all();

        foreach($this->attributes["fields"] as $field) {
            $values = isset($field["value"]) ? $field["value"] : null;
            $identifier = isset($field["identifier"]) ? $field["identifier"] : null;
            $type = isset($field["type"]) ? $field["type"] : null;

            if($values && $type && $identifier) {
                $this
                    ->getFieldObject($type, $fieldObjects) // <= Better into FieldObject like FieldHandler ?
                    ->save($content, $identifier, $values, $languages);
            }
        }
    }

    public function saveCategories()
    {
        $this->content->categories()->detach();
        $category = isset($this->attributes['category_id']) ? Category::find($this->attributes['category_id']) : null;

        if($category) {
            $this->content->categories()->attach($category);
        }
    }

    public function saveTags()
    {
        $this->content->tags()->detach();
        $tags = isset($this->attributes['tags']) ? Tag::whereIn('id', collect($this->attributes['tags'])->filter(function($tag){
            return isset($tag['id']) ? $tag['id'] : false;
        }))->get() : null;

        if($tags) {
            $this->content->tags()->attach($tags);
        }
    }

    public function handle()
    {
        $this->content = Content::create([
            'status' => $this->attributes['status'] ? $this->attributes['status'] : 0,
            'typology_id' => isset($this->attributes['typology_id']) ? $this->attributes['typology_id'] : null,
            'author_id' => $this->attributes['author_id'],
        ]);

        $this->saveCategories();
        $this->saveTags();

        // IF content with typology
        if($this->content->typology_id) {
            $this->saveTypologyContent($this->content);
        }

        $this->content->load('tags');

        return $this->content;
    }
}
