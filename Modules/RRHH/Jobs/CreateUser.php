<?php

namespace Modules\RRHH\Jobs;

use Modules\RRHH\Http\Requests\CreateUserRequest;
use App\Models\User;
use Hash;

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
            'partner_id',
            'image',
        ]);
    }

    public static function fromRequest(CreateUserRequest $request)
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
            'partner_id' => $this->attributes['partner_id'],
            'image' => $this->attributes['image'],
            'status' => $this->attributes['status']
        ]);

        $user->roles()->sync($this->attributes['role_id']);

        return $user->id;
    }
}
