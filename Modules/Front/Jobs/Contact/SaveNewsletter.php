<?php

namespace Modules\Front\Jobs\Contact;

use Modules\Front\Http\Requests\SaveNewsletterRequest;

use  Modules\Front\Entities\ContactForm;
use Modules\ExternalApi\Entities\Program;

use Mail;

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

        $programs = Program::pluck('description_es','id');

        if(sizeof($programValues) > 0){
            foreach($programValues as $index => $programValue){
              $programsResult .= $programs[$index].";";
            }
        }

        //dd($initProgram);
        //dd($programValues,$programsResult);
        //dd($this->attributes['initProgram']);

        $contactResult = ContactForm::create([
          'firstname' => $this->attributes['firstname'],
          'lastname' => $this->attributes['lastname'],
          'email'=> $this->attributes['email'],
          'country'=> $this->attributes['country'],
          'language'=> $this->attributes['language'],
          'company'=> $this->attributes['company'],
          'occupation'=> $this->attributes['occupation'],
          'comment'=> $this->attributes['comment'],
          'privacity'=> $this->attributes['privacity'],
          'newsletter'=> 1,
          'programs'=> $programsResult,
          'program_values' => json_encode($programValues),
          'type' => 'newsletter'
        ]);

        if($contactResult){

          $data = $this->attributes;
          $data["programs"] = $programsResult;

          //TODO add email to subscription

          Mail::send('front::emails.newsletter', $data, function ($message) use ($data) {

            $message->from($data['email'], $data['firstname']);

            $message->to(env('MAIL_COMPANY_EMAIL'))
              ->cc($data['email'])
              ->subject("Suscripción Newsletter");
          });

          return true;
        }
        else {
          return false;
        }

    }

}
