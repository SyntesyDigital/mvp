<?php

namespace Modules\Turisme\Jobs\Contact;

use Modules\Turisme\Http\Requests\SaveContactWithSelectionRequest;

class SaveContactWithSelection
{
    public function __construct($attributes)
    {
        $this->attributes = array_only($attributes, [
            'typology_id'
        ]);
    }

    public static function fromRequest(SaveContactWithSelectionRequest $request)
    {
        return new self($request->all());
    }


    public function handle()
    {
        return true;
    }

}
