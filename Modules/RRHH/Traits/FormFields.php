<?php
namespace Modules\RRHH\Traits;

trait FormFields
{
    public function getFields($form = null)
    {
        $form = $form ? $form : config('offers.form');

        return collect($this->parseNode(array_collapse($form)))
            ->map(function ($field) {
                return isset($field['name']) ? str_replace('[]', '', $field['name']) : false;
            })
            ->reject(function ($field) {
                return empty($field);
            })
            ->toArray();
    }

    public function parseNode($nodes, $fields = [])
    {
        foreach ($nodes as $node) {
            $childs = isset($node['childs']) ? $node['childs'] : null;

            if ($childs) {
                $fields = $this->parseNode($childs, $fields);
            }

            if ((isset($node['type'])) && 'field' == $node['type']) {
                $fields[] = $node;
            }
        }

        return $fields;
    }


    public function saveFields($entity)
    {
        $entity->fields()->delete();

        foreach ($this->fields as $name) {
            $value = isset($this->attributes[$name]) ? $this->attributes[$name] : null;

            $fieldClass = $entity->fieldModel;
            $relationKey = $entity->fieldKey;

            if ($value && !array_key_exists($name, $entity->toArray())) {
                if (is_array($value)) {
                    foreach ($value as $k => $v) {
                        $fieldClass::create([
                            $relationKey => $entity->id,
                            'name' => $name,
                            'value' => trim($v),
                        ]);
                    }
                } else {
                    $fieldClass::create([
                        $relationKey => $entity->id,
                        'name' => $name,
                        'value' => trim($value),
                    ]);
                }
            }
        }
    }
}
