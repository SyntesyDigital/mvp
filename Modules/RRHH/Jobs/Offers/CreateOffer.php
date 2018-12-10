<?php

namespace Modules\RRHH\Jobs\Offers;

use Modules\RRHH\Http\Requests\Admin\Offers\CreateOfferRequest;
use Modules\RRHH\Entities\Offers\Offer;
use Modules\RRHH\Entities\Offers\OfferField;
use Config;

class CreateOffer
{
    public function __construct($attributes)
    {
        $this->fields = $this->getFields();
        $this->attributes = array_only($attributes, $this->fields);
    }

    public static function fromRequest(CreateOfferRequest $request)
    {

        return new self($request->all());
    }

    public function handle()
    {

        $offer = Offer::create([
            'status' => $this->attributes['status'],
            'recipient_id' => $this->attributes['recipient_id'],
            'customer_id' => isset($this->attributes['customer_id']) ? $this->attributes['customer_id'] : null,
            'customer_contact_id' => isset($this->attributes['customer_contact_id']) ? $this->attributes['customer_contact_id'] : null,
        ]);

        // Set tags
        $tags = isset($this->attributes['tags']) ? $this->attributes['tags'] : null;

        if ($tags) {
            $offer->tags()->sync($this->attributes['tags']);
        }

        // Set fields
        foreach ($this->fields as $name) {
            $value = isset($this->attributes[$name]) ? $this->attributes[$name] : null;

            if ($value && ! array_key_exists($name, $offer->toArray())) {
                if (is_array($value)) {
                    foreach ($value as $k => $v) {
                        OfferField::create([
                            'offer_id' => $offer->id,
                            'name' => $name,
                            'value' => trim($v),
                        ]);
                    }
                } else {
                    OfferField::create([
                        'offer_id' => $offer->id,
                        'name' => $name,
                        'value' => trim($value),
                    ]);
                }
            }
        }

        return $offer;
    }

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
