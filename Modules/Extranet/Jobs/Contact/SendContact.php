<?php

namespace Modules\Extranet\Jobs\Contact;

use Illuminate\Support\Facades\Mail;

class SendContact
{
    public function __construct(array $attributes = [])
    {
        $this->inputs = array_only($attributes, [
            'last_name',
            'first_name',
            'email',
            'subject',
            'message',
        ]);
    }

    public function handle()
    {
        $params = [
            'subject' => $this->inputs['subject'],
            'lastname' => $this->inputs['last_name'],
            'name' => $this->inputs['first_name'],
            'email' => $this->inputs['email'],
            'subject' => $this->inputs['subject'],
            'comment' => $this->inputs['message'],
        ];
        //at the momoent for testing
        Mail::send(['html' => 'front::emails.contact'],
            $params,
            function ($message) use ($params) {
                $message
                ->from($params['email'],$params['name'].' '.$params['lastname'])
                ->to(env('MAIL_COMPANY_EMAIL'), env('MAIL_COMPANY_NAME'))
                ->bcc($params['email'],$params['name'].' '.$params['lastname'])
                ->subject('Nouveau mail de contact');
            }
        );

        return true;
    }
}
