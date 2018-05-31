<?php

namespace Modules\Architect\Jobs\Typology;

use Modules\Architect\Http\Requests\Typology\UpdateTypologyRequest;
use Modules\Architect\Entities\Typology;
use Modules\Architect\Entities\Field;

class UpdateTypology
{
    public function __construct(Typology $typology, $attributes)
    {
        $this->typology = $typology;
        $this->attributes = array_only($attributes, [
            'name',
            'fields',
            'identifier',
            'icon',
        ]);
    }

    public static function fromRequest(Typology $typology, UpdateTypologyRequest $request)
    {
        return new self($typology, $request->all());
    }

    public function handle()
    {
        $this->typology->update([
            'name' => $this->attributes["name"],
            'identifier' => $this->attributes["identifier"],
            'icon' => isset($this->attributes["icon"]) ? $this->attributes["icon"] : null,
        ]);

        $this->typology->fields()->delete();

        foreach($this->attributes["fields"] as $field) {
            $this->typology->fields()->save(new Field([
                'icon' => $field['icon'],
                'name' => $field['name'],
                'identifier' => $field['identifier'],
                'type' => $field['type'],
                'settings' => isset($field['settings']) ? $field['settings'] : null,
            ]));
        }

        return $this->typology->load('fields');
    }
}
