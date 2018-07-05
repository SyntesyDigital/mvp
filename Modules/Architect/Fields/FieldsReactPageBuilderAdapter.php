<?php

namespace Modules\Architect\Fields;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;

use Modules\Architect\Entities\Media;
use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\ContentField;
use Modules\Architect\Entities\Page;
use Modules\Architect\Entities\Language;
use Modules\Architect\Fields\FieldConfig;

class FieldsReactPageBuilderAdapter
{
    public function __construct(Content $content)
    {
        $this->content = $content;
        $this->page = $content->page;
        $this->languages = Language::all();
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
                        $nodes[$key]['field']['name'] = $node['field']['type'];
                        $nodes[$key]['field']['value'] = $this->buildPageField($node['field']);
                    }
                }
            }
        }

        return $nodes;
    }


    private function buildPageField($field)
    {
        $fieldName = isset($field['name']) ? $field['name'] : null;

        switch($field["type"]) {
            case 'richtext':
            case 'slug':
            case 'text':
                return ContentField::where('name', $fieldName)->get()->mapWithKeys(function($field) {
                    return [$field->language->iso => $field->value];
                })->toArray();
            break;

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

            default:
                $fields = ContentField::where('name', $fieldName)->first();
                return $fields ? $fields->value : null;
            break;
        }

        return null;
    }

}
?>
