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
        return $this->getFields($nodes);
    }


    function getFields(&$nodes) {
        foreach ($nodes as $key => $node) {
            if(isset($node['children'])) {
                $nodes[$key]['children'] = $this->getFields($node['children']);
            } else {
                if(isset($node['field'])) {
                    $nodes[$key]['field']['fieldname'] = $nodes[$key]['field']['name'];
                    $nodes[$key]['field']['name'] = $node['field']['type'];
                    $nodes[$key]['field']['value'] = $this->build($node['field']);
                }
            }
        }
        return $nodes;
    }


    private function build($field)
    {
        $fieldName = isset($field['name']) ? $field['name'] : null;

        switch($field["type"]) {
            case 'richtext':
            case 'text':
                return ContentField::where('name', $fieldName)->get()->mapWithKeys(function($field) {
                    return [$field->language->iso => $field->value];
                })->toArray();
            break;
        }

        return null;
    }

}
?>
