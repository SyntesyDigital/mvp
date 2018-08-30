<?php

namespace Modules\Turisme\Jobs\Contact;

use Modules\Turisme\Http\Requests\SaveNewsletterRequest;

use  Modules\Turisme\Entities\ContactForm;
use Modules\ExternalApi\Entities\Program;

class SaveNewsletter
{
    public function __construct($attributes)
    {
        $this->attributes = array_only($attributes, [
            'firstname',
            'lastname',
            'email',
            'country',
            'language',
            'company',
            'occupation',
            'comment',
            'privacity',
            //'newsletter',
            'programCheckboxes'
        ]);
    }

    public static function fromRequest(SaveNewsletterRequest $request)
    {
        return new self($request->all());
    }


    public function handle()
    {
        $programValues = $this->attributes['programCheckboxes'];
        $programsResult = '';

        $programs = Program::pluck('description_es','code');

        if(sizeof($programValues) > 0){
            foreach($programValues as $programValue){
              $programsResult .= $programs[$programValue].";";
            }
        }

        //dd($initProgram);
        //dd($programValues,$programsResult);
        //dd($this->attributes['initProgram']);

        return ContactForm::create([
          'firstname' => $this->attributes['firstname'],
          'lastname' => $this->attributes['lastname'],
          'email'=> $this->attributes['email'],
          'country'=> $this->attributes['country'],
          'language'=> $this->attributes['language'],
          'company'=> $this->attributes['company'],
          'occupation'=> $this->attributes['occupation'],
          'comment'=> $this->attributes['comment'],
          'privacity'=> $this->attributes['privacity'],
          'newsletter'=> $this->attributes['newsletter'],
          'programs'=> $programsResult,
          'program_values' => json_encode($programValues),
          'type' => 'newsletter'
        ]);
    }

}
