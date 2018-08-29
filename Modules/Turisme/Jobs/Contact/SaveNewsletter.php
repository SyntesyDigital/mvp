<?php

namespace Modules\Turisme\Jobs\Contact;

use Modules\Turisme\Http\Requests\SaveNewsletterRequest;

class SaveNewsletter
{
    public function __construct($attributes)
    {
        $this->attributes = array_only($attributes, [
            'typology_id'
        ]);
    }

    public static function fromRequest(SaveNewsletterRequest $request)
    {
        return new self($request->all());
    }


    public function handle()
    {
        return true;
    }

}
