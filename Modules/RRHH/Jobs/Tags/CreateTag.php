<?php

namespace Modules\RRHH\Jobs\Tags;

use Modules\RRHH\Entities\Tag;

class CreateTag
{
    public function __construct(array $attributes = [])
    {
        $this->attributes = array_only($attributes, [
            'name',
        ]);
    }

    public static function fromRequest($name)
    {
        $attr = ['name' => $name];

        return new self($attr);
    }

    public function handle()
    {
        return Tag::create($this->attributes);
    }
}
