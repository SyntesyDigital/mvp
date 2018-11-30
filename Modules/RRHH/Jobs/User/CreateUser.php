<?php

namespace Modules\RRHH\Jobs\User;

use Modules\RRHH\Http\Requests\User\UserRequest;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Mail;

class CreateUser
{
    public function __construct(
        string $firstname,
        string $lastname,
        string $email,
        int $roleId,
        string $password,
        string $status,
        int $agenceId = null,
        string $telephone = null
    ) {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->roleId = $roleId;
        $this->password = $password;
        $this->status = $status;
        $this->agenceId = $agenceId;
        $this->telephone = $telephone;
    }

    public static function fromRequest(UserRequest $request)
    {
        return new self(
            $request->get('firstname'),
            $request->get('lastname'),
            $request->get('email'),
            $request->get('role_id'),
            $request->get('password'),
            $request->get('status'),
            null !== $request->get('agence') ? $request->get('agence') : null,
            $request->get('telephone')
        );
    }

    public function handle()
    {
        $user = new User([
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'telephone' => $this->telephone,
            'password' => trim(Hash::make($this->password)),
            'status' => $this->status,
        ]);
        $user->save();
        $user->roles()->sync($this->roleId);
        if ($this->agenceId) {
            $user->agences()->sync($this->agenceId);
        }
        switch ($this->roleId) {
            case 4: //candidate
                // Email to new candidate
                $recipient = $this->email;
                $params = [
                    'user' => $user,
                    'password' => $this->password,
                    'subject' => 'Bienvenue sur menco.fr !',
                    'reply_to' => 'info@menco.fr',
                ];
                Mail::send(['html' => 'emails.createcandidate'],
                    $params,
                    function ($message) use ($params, $recipient) {
                        $message->to($recipient, null)
                        ->replyTo($params['reply_to'], null)
                        ->subject($params['subject']);
                    }
                );
            break;

            case 1: //admin
            case 2: //user
                // Email to new candidate
                $body = 'Votre mot de passe est '.$this->password;
                $subject = 'Admin Enregistré';
                $recipient = $this->email;
                $params = ['body' => $body,
                           'subject' => $subject,
                           'reply_to' => 'info@menco.fr', ];
                Mail::send(['html' => 'emails.createadmin'],
                    $params,
                    function ($message) use ($params,$recipient) {
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
