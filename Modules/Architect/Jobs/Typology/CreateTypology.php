<?php

namespace Modules\Architect\Jobs\Typology;

use Modules\Architect\Http\Requests\Typology\CreateTypologyRequest;
use Modules\Architect\Entities\Typology;
use Modules\Architect\Entities\Field;

class CreateTypology
{

    public function __construct($attributes)
    {
        $this->attributes = array_only($attributes, [
            'name',
            'fields',
            'identifier',
            'icon',
        ]);
    }

    public static function fromRequest(CreateTypologyRequest $request)
    {
        return new self($request->all());
    }

    public function handle()
    {
        $typology = Typology::create([
            'name' => $this->attributes["name"],
            'identifier' => $this->attributes["identifier"],
            'icon' => isset($this->attributes["icon"]) ? $this->attributes["icon"] : null,
        ]);

        foreach($this->attributes["fields"] as $field) {
            $typology->fields()->save(new Field([
                'icon' => $field['icon'],
                'name' => $field['name'],
                'identifier' => $field['identifier'],
                'type' => $field['type'],
                'rules' => isset($field['rules']) ? $field['rules'] : null,
                'settings' => $field['settings'],
            ]));
        }

        return $typology;
    }
}
