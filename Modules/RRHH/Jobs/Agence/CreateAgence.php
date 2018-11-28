<?php

namespace Modules\RRHH\Jobs\Agence;

use Modules\RRHH\Http\Requests\Agence\AgenceRequest;
use Modules\RRHH\Entities\Agence;

class CreateAgence
{
    public function __construct(
        array $attributes = [])
    {
        $this->attributes = array_only($attributes, [
            'name',
            'content',
            'meta_title',
            'slug',
            'email',
            'phone',
            'meta_description',
            'fax',
            'address',
            'postal_code',
            'image',
            'latitude',
            'longitude',
        ]);
    }

    public static function fromRequest(AgenceRequest $request)
    {
        return new self($request->all());
    }

    public function handle()
    {
        $agence = new Agence([
            'name' => $this->attributes['name'],
            'content' => $this->attributes['content'],
            'meta_title' => $this->attributes['meta_title'],
            'slug' => $this->attributes['slug'],
            'meta_description' => $this->attributes['meta_description'],
            'email' => $this->attributes['email'],
            'phone' => $this->attributes['phone'],
            'fax' => $this->attributes['fax'],
            'address' => $this->attributes['address'],
            'postal_code' => $this->attributes['postal_code'],
            'image' => $this->attributes['image'],
            'latitude' => $this->attributes['latitude'],
            'longitude' => $this->attributes['longitude'],
        ]);
        $agence->Save();

        return $agence;
    }
}
