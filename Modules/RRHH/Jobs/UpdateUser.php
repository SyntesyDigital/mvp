<?php

namespace Modules\RRHH\Jobs;

use Modules\RRHH\Http\Requests\UpdateUserRequest;
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
            'password',
            'telephone',
            'partner_id',
            'role_id',
            'image',
            'status',
            'city',
            'postal_code',
            'address',
        ]);
    }

    public static function fromRequest(User $user, UpdateUserRequest $request): self
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
            'partner_id',
            'image',
            'status',
            'city',
            'postal_code',
            'address',
        ]));

        if (isset($this->attributes['password']) && '' !== trim($this->attributes['password'])) {
            $this->user->update(['password' => trim(Hash::make($this->attributes['password']))]);
        }

        $this->user->roles()->sync($this->attributes['role_id']);

        return $this->user;
    }
}
