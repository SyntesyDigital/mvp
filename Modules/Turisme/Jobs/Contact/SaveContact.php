<?php

namespace Modules\Turisme\Jobs\Contact;

use Modules\Turisme\Http\Requests\SaveContactRequest;

use  Modules\Turisme\Entities\ContactForm;
use Modules\ExternalApi\Entities\Program;

class SaveContact
{
    public function __construct($attributes)
    {
        $this->attributes = array_only($attributes, [
            'firstname',
            'lastname',
            'email',
            'country',
            'company',
            'company_type',
            'comment',
            'privacity',
            'newsletter',
            'programCheckboxes',
            'initProgram'
        ]);
    }

    public static function fromRequest(SaveContactRequest $request)
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

        $initProgram = '';
        if(isset($this->attributes['initProgram']) && $this->attributes['initProgram'] != ''){
          if(isset($programs[$this->attributes['initProgram']])){
            $initProgram = $programs[$this->attributes['initProgram']];
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
          'company'=> $this->attributes['company'],
          'company_type'=> $this->attributes['company_type'],
          'comment'=> $this->attributes['comment'],
          'privacity'=> $this->attributes['privacity'],
          'newsletter'=> $this->attributes['newsletter'],
          'programs'=> $programsResult,
          'program_values' => json_encode($programValues),
          'init_program'=> $initProgram,
          'init_program_value'=> $this->attributes['initProgram'],
          'type' => 'contact'
        ]);
    }

}
