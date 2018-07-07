<?php

namespace Modules\Architect\Jobs\Content;

use Modules\Architect\Http\Requests\Content\CreateContentRequest;
use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\Page;
use Modules\Architect\Entities\Tag;
use Modules\Architect\Entities\Category;
use Modules\Architect\Entities\ContentField;
use Modules\Architect\Entities\Language;
use Modules\Architect\Fields\FieldConfig;

class CreateContent
{

    public function __construct($attributes)
    {
        $this->languages = Language::all();
        $this->attributes = array_only($attributes, [
            'typology_id',
            'author_id',
            'category_id',
            'parent_id',
            'status',
            'fields',
            'tags',
            'page',
            'translations',
            'is_page',
        ]);
    }

    public static function fromRequest(CreateContentRequest $request)
    {
        return new self($request->all());
    }


    public function handle()
    {
        $this->content = Content::create([
            'status' => $this->attributes['status'] ? $this->attributes['status'] : 0,
            'typology_id' => isset($this->attributes['typology_id']) ? $this->attributes['typology_id'] : null,
            'author_id' => $this->attributes['author_id'],
            'is_page' => isset($this->attributes['is_page']) ? $this->attributes['is_page'] : 0,
            'parent_id' => isset($this->attributes['parent_id']) ? $this->attributes['parent_id'] : null,
        ]);

        $this->saveCategories();
        $this->saveTags();
        $this->saveLanguages();

        if((isset($this->attributes['is_page'])) && $this->attributes['is_page'] == 1) {
            $this->savePage();
        } else {
            $this->saveFields();
        }

        return $this->content;
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


    public function saveFields()
    {
        $fieldObjects = FieldConfig::get();

        foreach($this->attributes["fields"] as $field) {
            $values = isset($field["value"]) ? $field["value"] : null;
            $identifier = isset($field["identifier"]) ? $field["identifier"] : null;
            $type = isset($field["type"]) ? $field["type"] : null;

            if($values && $type && $identifier) {
                $this
                    ->getFieldObject($type, $fieldObjects) // <= Better into FieldObject like FieldHandler ?
                    ->save($this->content, $identifier, $values, $this->languages);
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

        $this->content->load('tags');
    }

    public function saveLanguages()
    {
        $this->content->languages()->detach();
        if(isset($this->attributes['translations'])) {
            foreach($this->attributes['translations'] as $iso => $value) {
                $language = $value ? Language::where('iso', $iso)->first() : null;

                if($language) {
                    $this->content->languages()->attach($language);
                }
            }
        }

    }

    function savePageBuilderFields(&$nodes) {
        if($nodes) {
            foreach ($nodes as $key => $node) {

                if(isset($node['children'])) {
                    $nodes[$key]['children'] = $this->savePageBuilderFields($node['children']);
                } else {
                    if(isset($node['field'])) {
                        $field = $node['field'];

                        $fieldName = uniqid('pagefield_');
                        $fieldValue = isset($field['value']) ? $field['value'] : null;

                        (new $field['class'])->save($this->content, $fieldName, $fieldValue, $this->languages);
                        unset($nodes[$key]['field']['value']);

                        $nodes[$key]['field']['name'] = $fieldName;
                    }
                }
            }
        }

        return $nodes;
    }


    public function savePage()
    {
        return Page::create([
            'definition' => json_encode($this->savePageBuilderFields($this->attributes['page'])),
            'content_id' => $this->content->id
        ]);
    }



}
