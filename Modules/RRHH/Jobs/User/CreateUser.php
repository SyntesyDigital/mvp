<?php

namespace Modules\RRHH\Jobs\User;

use Modules\RRHH\Http\Requests\User\UserRequest;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Mail;

class CreateUser
{
    public function __construct(array $attributes = [])
    {
        $this->attributes = array_only($attributes, [
            'firstname',
            'lastname',
            'email',
            'role_id',
            'password',
            'status',
            'telephone',
            'agence',
            'linkedin_id'
        ]);
    }

    public static function fromRequest(UserRequest $request)
    {
        return new self($request->all());
    }

    public function handle()
    {
        $user = User::create([
            'firstname' => $this->attributes['firstname'],
            'lastname' => $this->attributes['lastname'],
            'email' => $this->attributes['email'],
            'password' => trim(Hash::make($this->attributes['password'])),
            'telephone' => $this->attributes['telephone'],
            'status' => $this->attributes['status'],
            'language' => 'fr',
            'linkedin_id' => isset($this->attributes['linkedin_id']) ? $this->attributes['linkedin_id'] : null,
        ]);

        if(isset($this->attributes['role_id'])) {
            $user->roles()->sync($this->attributes['role_id']);
        }

        if (isset($this->attributes['agence'])) {
            $user->agences()->sync($this->attributes['agence']);
        }

        switch ($this->attributes['role_id']) {
            case 3: //candidate
                $recipient = $this->attributes['email'];

                $params = [
                    'user' => $user,
                    'password' => $this->attributes['password'],
                    'subject' => 'Bienvenue sur BWO-interim !',
                    'reply_to' => env('MAIL_COMPANY_EMAIL')
                ];

                Mail::send(['html' => 'bwo::emails.createcandidate'],
                    $params,
                    function ($message) use ($params, $recipient) {
                        $message->to($recipient, null)
                        ->replyTo($params['reply_to'], null)
                        ->subject($params['subject']);
                    }
                );
            break;

            case 1: //admin
            case 2: //recruiter
                $recipient = $this->email;

                $params = [
                    'body' => $body,
                    'subject' => $subject,
                    'reply_to' => env('MAIL_COMPANY_EMAIL')
                ];

                Mail::send(['html' => 'bwo::emails.createadmin'],
                    $params,
                    function ($message) use ($params, $recipient) {
                        $message->to($recipient, null)
                        ->replyTo($params['reply_to'], null)
                        ->subject($params['subject']);
                    }
                );
            break;
        }

        return $user;
    }
}
