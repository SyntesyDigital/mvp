<?php

namespace Modules\Architect\Jobs\User;

use Modules\Architect\Http\Requests\User\UpdateUserRequest;

use App\Models\User;
use Modules\Architect\Entities\Language;

class UpdateUser
{
    public function __construct(User $user, $attributes)
    {
        $this->user = $user;

        $this->attributes = array_only($attributes, [
            'firstname',
            'lastname',
            'email',
            'password',
            'image',
        ]);
    }

    public static function fromRequest(User $user, UpdateUserRequest $request)
    {
        return new self($user, $request->all());
    }

    public function handle()
    {
        return $this->user->update($this->attributes);
    }
}
