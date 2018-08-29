<?php

namespace Modules\Turisme\Jobs\Contact;

use Modules\Turisme\Http\Requests\SavePressRequest;

class SavePress
{
    public function __construct($attributes)
    {
        $this->attributes = array_only($attributes, [
            'typology_id'
        ]);
    }

    public static function fromRequest(SavePressRequest $request)
    {
        return new self($request->all());
    }


    public function handle()
    {
        return true;
    }

}
