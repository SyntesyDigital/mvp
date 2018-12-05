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
        ]);

        if(isset($this->attributes['role_id'])) {
            $user->roles()->sync($this->attributes['role_id']);    
        }


        if (isset($this->attributes['agence'])) {
            $user->agences()->sync($this->attributes['agence']);
        }

        // switch ($this->attributes['role_id']) {
        //     case 4: //candidate
        //         // Email to new candidate
        //         $recipient = $this->email;
        //         $params = [
        //             'user' => $user,
        //             'password' => $this->attributes['password'],
        //             'subject' => 'Bienvenue sur BWO-interim !',
        //             'reply_to' => '',
        //         ];
        //         Mail::send(['html' => 'emails.createcandidate'],
        //             $params,
        //             function ($message) use ($params, $recipient) {
        //                 $message->to($recipient, null)
        //                 ->replyTo($params['reply_to'], null)
        //                 ->subject($params['subject']);
        //             }
        //         );
        //     break;
        //
        //     case 1: //admin
        //     case 2: //user
        //         // Email to new candidate
        //         $body = 'Votre mot de passe est '.$this->password;
        //         $subject = 'Admin Enregistré';
        //         $recipient = $this->email;
        //         $params = ['body' => $body,
        //                    'subject' => $subject,
        //                    'reply_to' => 'info@menco.fr', ];
        //         Mail::send(['html' => 'emails.createadmin'],
        //             $params,
        //             function ($message) use ($params,$recipient) {
        //                 $message->to($recipient, null)
        //                 ->replyTo($params['reply_to'], null)
        //                 ->subject($params['subject']);
        //             }
        //         );
        //     break;
        // }

        return $user;
    }
}
