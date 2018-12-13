<?php
namespace Modules\RRHH\Traits;

trait OfferFields
{
    public function getFields()
    {
        return collect($this->parseNode(array_collapse(config('offers.form'))))
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
}
