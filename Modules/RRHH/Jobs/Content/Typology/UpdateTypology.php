<?php

namespace Modules\RRHH\Jobs\Content\Typology;

use Modules\RRHH\Http\Requests\Admin\Content\Typology\UpdateTypologyRequest;
use Modules\RRHH\Entities\Content\Typology;

class UpdateTypology
{
    private $fields = [
        'name',
        'identifier',
        'definition',
        'customizable',
        'display_menu',
    ];

    public function __construct(Typology $typology, array $attributes = [])
    {
        $this->attributes = array_only($attributes, $this->fields);
        $this->typology = $typology;
    }

    public static function fromRequest($typology, UpdateTypologyRequest $request)
    {
        return new self($typology, $request->all());
    }

    public function handle()
    {
        $this->typology->update($this->attributes);

        return true;
    }
}
