<?php

namespace Modules\RRHH\Jobs\Contact;

use Illuminate\Support\Facades\Mail;

class SendContact
{
    public function __construct(array $attributes = [])
    {
        $this->inputs = array_only($attributes, [
            'lastname',
            'name',
            'email',
            'subject',
            'message',
        ]);
    }

    public function handle()
    {
        $params = [
            'subject' => $this->inputs['subject'],
            'lastname' => $this->inputs['lastname'],
            'name' => $this->inputs['name'],
            'email' => $this->inputs['email'],
            'subject' => $this->inputs['subject'],
            'comment' => $this->inputs['message'],
        ];
        //at the momoent for testing
        Mail::send(['html' => 'bwo::emails.contact'],
            $params,
            function ($message) use ($params) {
                $message->to(env('MAIL_COMPANY_EMAIL'), null)
                ->subject('Nouveau mail de contact');
            }
        );

        return true;
    }
}
