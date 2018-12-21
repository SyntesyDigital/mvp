<?php

namespace Modules\RRHH\Jobs\User;

use Modules\RRHH\Http\Requests\User\UserRequest;
use App\Models\User;
use Hash;

class UpdateUser
{
    /**
     * @var \App\Models\User
     */
    private $user;

    /**
     * @var array
     */
    private $attributes;

    public function __construct(User $user, array $attributes = [])
    {
        $this->user = $user;
        $this->attributes = array_only($attributes, [
            'firstname',
            'lastname',
            'email',
            'telephone',
            'password',
            'role_id',
            'agence',
            'status',
            'image',
        ]);
    }

    public static function fromRequest(User $user, UserRequest $request): self
    {
        return new self($user, $request->all());
    }

    public function handle()
    {
        $this->user->update(array_only($this->attributes, [
            'firstname',
            'lastname',
            'email',
            'telephone',
            'status',
            'city',
            'image'
        ]));

        if (isset($this->attributes['password']) && '' !== trim($this->attributes['password'])) {
            $this->user->update(['password' => trim(Hash::make($this->attributes['password']))]);
        }

        if (isset($this->attributes['role_id'])) {
            $this->user->roles()->sync($this->attributes['role_id']);
        }
        if (isset($this->attributes['agence'])) {
            $this->user->agences()->sync($this->attributes['agence']);
        }

        return $this->user;
    }
}
