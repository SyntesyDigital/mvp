<?php

namespace Modules\Turisme\Jobs\Contact;

use Modules\Turisme\Http\Requests\SavePressRequest;
use  Modules\Turisme\Entities\ContactPress;

class SavePress
{
    public function __construct($attributes)
    {
        $this->attributes = array_only($attributes, [
            'media_type',
            'media_name',
            'media_distribution',
            'media_country',
            'media_web',
            'media_email',
            'media_comment',

            'firstname',
            'lastname',
            'gender',
            'email',
            'country',
            'occupation',
            'web',
            'language',
            'dateStart',
            'dateEnd',
            'comment',

            'privacity',
            'newsletter',
        ]);
    }

    public static function fromRequest(SavePressRequest $request)
    {
        return new self($request->all());
    }


    public function handle()
    {

        return ContactPress::create($this->attributes);
    }

}
