<?php

namespace Modules\Turisme\Adapters;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;

use Modules\Architect\Entities\Media;
use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\ContentField;
use Modules\Architect\Entities\Page;
use Modules\Architect\Entities\Language;
use Modules\Architect\Fields\FieldConfig;

use Modules\Architect\Transformers\ContentTransformer;
use Modules\Architect\Ressources\ContentCollection;

class PageBuilderAdapter
{
    public function __construct(Content $content, $languages = null)
    {
        $this->content = $content;
        $this->page = $content->page;
        $this->languages = $languages ? $languages : Language::all();
    }

    public function get()
    {
        $nodes = json_decode($this->page->definition, true);
        return $this->getPage($nodes);
    }

    private function getLanguageIsoFromId($id)
    {
        foreach($this->languages as $language) {
            if($language->id == $id) {
                return $language->iso;
            }
        }

        return false;
    }

    function getPage(&$nodes) {

        if($nodes) {
            foreach ($nodes as $key => $node) {
                if(isset($node['children'])) {
                    $nodes[$key]['children'] = $this->getPage($node['children']);
                } else {
                    if(isset($node['field'])) {
                        $nodes[$key]['field']['fieldname'] = $nodes[$key]['field']['name'];
                        //$nodes[$key]['field']['name'] = $node['field']['type'];

                        switch($nodes[$key]['field']['type']) {
                            case "widget-list":
                                $nodes[$key]['field']['value'] = $this->buildPageField($node['field']);
                            break;

                            case "widget":
                                $nodes[$key]['field']['fields'] = $this->buildPageField($node['field']);

                                $typologyId = isset($nodes[$key]['field']['settings']['typology']) ? $nodes[$key]['field']['settings']['typology'] : null;
                                $categoryId = isset($nodes[$key]['field']['settings']['category']) ? $nodes[$key]['field']['settings']['category'] : null;

                                if($typologyId) {
                                    $content = Content::where('typology_id', $typologyId);

                                    if($categoryId) {
                                        $content->whereHas('categories', function($q) use ($categoryId){
                                            $q->where('category_id', $categoryId);
                                        });
                                    }

                                    $nodes[$key]['field']['contents'] = $content->with('fields', 'categories')->get()->map(function($content) {
                                        return (new ContentTransformer($content))->toArray(request());
                                    })->toArray();
                                }
                            break;

                            default:
                                $nodes[$key]['field']['value'] = $this->buildPageField($node['field']);
                        }
                    }
                }
            }
        }

        return $nodes;
    }

    private function buildPageField($field, $name = null)
    {
        $fieldName = isset($field['fieldname']) ? $field['fieldname'] : null;

        if($name) {
            $fieldName = $name;
        }

        switch($field["type"]) {
            case 'richtext':
            case 'slug':
            case 'text':
                return ContentField::where('name', $fieldName)->get()->mapWithKeys(function($field) {
                    return [$field->language->iso => $field->value];
                })->toArray();
            break;

            case 'file':
            case 'image':
                $contentField = ContentField::where('name', $fieldName)->first();
                if($contentField != null){
                  return Media::find($contentField->value);
                }
            break;

            case 'localization':
                $contentField = ContentField::where('name', $fieldName)->first();
                if($contentField != null){
                  return json_decode($contentField->value, true);
                }
            break;

            case 'images':
                return ContentField::where('name', $fieldName)->get()->map(function($field){
                    return Media::find($field->value);
                })->toArray();
            break;

            case 'contents':
                return ContentField::where('name', $fieldName)->get()->map(function($field){
                    return Content::find($field->value);
                })->map(function($content) {
                    return (new ContentTransformer($content))->toArray(request());
                })->toArray();
            break;

            case 'video':
                $field = ContentField::where('name', $fieldName)->first();
                $values = null;

                if($field) {
                    $childs = $this->content->getFieldChilds($field);

                    if($childs != null){
                      foreach($childs as $k => $v) {
                          if($v->language_id) {
                              $iso = $this->getLanguageIsoFromId($v->language_id);
                              $values[ explode('.', $v->name)[1] ][$iso] = $v->value;
                          }
                      }
                    }
                }
                return $values;
            break;

            case 'link':
                $field = ContentField::where('name', $fieldName)->first();
                $values = null;

                if($field) {
                    $childs = $this->content->getFieldChilds($field);

                    if($childs != null){
                      foreach($childs as $k => $v) {
                          if($v->language_id) {
                              $iso = $this->getLanguageIsoFromId($v->language_id);
                              $values[ explode('.', $v->name)[1] ][$iso] = $v->value;
                          } else {
                              if(explode('.', $v->name)[1] == 'content') {
                                  $values[ explode('.', $v->name)[1] ] = Content::find($v->value);
                              }
                          }
                      }
                    }
                }
                return $values;
            break;

            case 'widget':
                $widget = (new $field['class']);
                $fields = [];
                foreach($widget->fields as $_field) {
                    if(!isset($_field['value'])) {
                        $_field['value'] = [];
                    }

                    $fieldName = $field['fieldname'] . "_" . $_field['identifier'];
                    $_field["value"] = $this->buildPageField($_field, $fieldName);
                    $fields[] = $_field;
                }
                return $fields;
            break;


            case 'widget-list':
                foreach($field["value"] as $k => $w) {
                    $widget = (new $w['class']);
                    $fields = [];
                    foreach($widget->fields as $_field) {
                        if(!isset($_field['value'])) {
                            $_field['value'] = [];
                        }

                        $fieldName = $w['fieldname'] . "_" . $_field['identifier'];
                        $_field["value"] = $this->buildPageField($_field, $fieldName);
                        $fields[] = $_field;
                    }
                    $field["value"][$k]["fields"] = $fields;
                }
                return $field["value"];
            break;

            default:
                $fields = ContentField::where('name', $fieldName)->first();
                return $fields ? $fields->value : null;
            break;
        }

        return null;
    }

}
?>
