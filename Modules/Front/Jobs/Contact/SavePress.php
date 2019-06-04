<?php

namespace Modules\Front\Jobs\Contact;

use Modules\Front\Http\Requests\SavePressRequest;
use  Modules\Front\Entities\ContactPress;

use Mail;

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
            'delivery',

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

        $contactResult = ContactPress::create($this->attributes);

        if($contactResult){

          $data = $this->attributes;

          Mail::send('front::emails.press', $data, function ($message) use ($data) {

            $message->from($data['email'], $data['firstname']);

            $message->to(env('MAIL_COMPANY_EMAIL'))
              ->cc($data['email'])
              ->subject("Contacto Prensa");

          });

          return true;
        }
        else {
          return false;
        }

    }

}