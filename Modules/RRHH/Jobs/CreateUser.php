<?php

namespace Modules\RRHH\Jobs;

use Modules\RRHH\Http\Requests\CreateUserRequest;
use App\Models\User;
use Hash;

class CreateUser
{
    public function __construct(
        string $firstname,
        string $lastname,
        string $email,
        int $roleId,
        string $password,
        string $status,
        string $telephone = null,
        int $partnerId = null,
        string $image = null
    ) {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->roleId = $roleId;
        $this->password = $password;
        $this->telephone = $telephone;
        $this->partner_id = $partnerId;
        $this->image = $image;
        $this->status = $status;
    }

    public static function fromRequest(CreateUserRequest $request)
    {
        return new self(
            $request->get('firstname'),
            $request->get('lastname'),
            $request->get('email'),
            $request->get('role_id'),
            $request->get('password'),
            $request->get('status'),
            $request->get('telephone'),
            $request->get('partner_id'),
            $request->get('image')
        );
    }

    public function handle()
    {
        $user = new User([
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'email' => $this->email,
            'password' => trim(Hash::make($this->password)),
            'telephone' => $this->telephone,
            'partner_id' => $this->partner_id,
            'image' => $this->image,
            'status' => $this->status,
        ]);
        $user->save();
        $user->roles()->sync($this->roleId);

        return $user->id;
    }
}
