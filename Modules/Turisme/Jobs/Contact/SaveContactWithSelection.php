<?php

namespace Modules\Turisme\Jobs\Contact;

use Modules\Turisme\Http\Requests\SaveContactWithSelectionRequest;

use  Modules\Turisme\Entities\ContactWithSelection;

class SaveContactWithSelection
{
    public function __construct($attributes)
    {
        $this->attributes = array_only($attributes, [
            'firstname',
            'lastname',
            'email',
            'country',
            'company',
            'comment',
            'privacity',
            'newsletter',
            'conditions',
            'items'
        ]);
    }

    public static function fromRequest(SaveContactWithSelectionRequest $request)
    {
        return new self($request->all());
    }


    public function handle()
    {
        return ContactWithSelection::create([
          'firstname' => $this->attributes['firstname'],
          'lastname' => $this->attributes['lastname'],
          'email'=> $this->attributes['email'],
          'country'=> $this->attributes['country'],
          'company'=> $this->attributes['company'],
          'comment'=> $this->attributes['comment'],
          'privacity'=> $this->attributes['privacity'],
          'newsletter'=> $this->attributes['newsletter'],
          'conditions'=> $this->attributes['conditions'],
          'items' => json_encode($this->attributes['items']),
        ]);
    }

}
