<?php

namespace Modules\Architect\Jobs\Content;

use Modules\Architect\Http\Requests\Content\CreateContentRequest;
use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\Category;
use Modules\Architect\Entities\Tag;
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
             'fields',
             'category_id',
             'tags',
             'is_page'
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
        $tags = isset($this->attributes['tags']) ? Tag::whereIn('id', collect($this->attributes['tags'])->pluck('id')->toArray())->get() : null;

        if($tags) {
            $this->content->tags()->attach($tags);
        }
    }

    public function handle()
    {
        $this->content->update([
            'status' => $this->attributes['status'] ? $this->attributes['status'] : 0,
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
