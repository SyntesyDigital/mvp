<?php

namespace Modules\Front\Jobs\Contact;

use Modules\Front\Http\Requests\SaveContactWithSelectionRequest;

use  Modules\Front\Entities\ContactWithSelection;

use Mail;
use Cache;
use App;

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
            'items',
            'items_value',
            'typology'
        ]);
    }

    public static function fromRequest(SaveContactWithSelectionRequest $request)
    {
        return new self($request->all());
    }

    public function handle()
    {
        $contactResult = ContactWithSelection::create([
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
          'items_value' => json_encode($this->attributes['items_value']),
          'typology'=> $this->attributes['typology']
        ]);

        //dd($this->attributes['items']);

        if($contactResult){

          $data = $this->attributes;

          Mail::send('front::emails.selection', $data, function ($message) use ($data) {

            $message->from($data['email'], $data['firstname']);

            $message->to(env('MAIL_MEDIA_CENTER_EMAIL'))
              ->cc($data['email'])
              ->subject("Mi Selección");

          });


          //send email with files
          $template = "";

          if($this->attributes['typology'] == 7){ //cartografia
            $template = "cartography";
          }
          else if($this->attributes['typology'] == 14){ //logos
            $template = "logos";
          }

          $localization = Cache::get('localization.'.App::getLocale());

          if($template != ""){
            Mail::send('front::emails.'.$template, $data, function ($message) use ($data,$localization) {

              $fromEmail = env('MAIL_MEDIA_CENTER_EMAIL');

              $message->from($fromEmail, env('MAIL_COMPANY_NAME'));

              $message->to($data['email'])
                ->cc($fromEmail)
                ->subject($localization["EMAIL_SELECTION_SUBJECT"]);

            });
          }

          return true;
        }
        else {
          return false;
        }
    }

}
