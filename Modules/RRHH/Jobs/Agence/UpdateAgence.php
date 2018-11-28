<?php

namespace Modules\RRHH\Jobs\Agence;

use Modules\RRHH\Http\Requests\Agence\AgenceRequest;
use Modules\RRHH\Entities\Agence;
use Storage;

class UpdateAgence
{
    public function __construct(Agence $agence, array $attributes = [])
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
        $this->agence = $agence;
    }

    public static function fromRequest(Agence $agence, AgenceRequest $request)
    {
        return new self($agence, $request->all());
    }

    public function handle()
    {
        if ($this->agence->image != $this->attributes['image'] && '' != $this->agence->image) {
            Storage::delete('public/agences/'.$this->agence->image);
        }

        $this->agence->update([
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

        return $this->agence;
    }
}
