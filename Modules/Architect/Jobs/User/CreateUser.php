<?php

namespace Modules\Architect\Jobs\User;

use Modules\Architect\Http\Requests\User\CreateUserRequest;

use App\Models\User;
use Modules\Architect\Entities\Language;

class CreateUser
{
    public function __construct($attributes = [])
    {
        $this->attributes = array_only($attributes, [
            'firstname',
            'lastname',
            'email',
            'password',
            'image',
        ]);
    }

    public static function fromRequest(CreateUserRequest $request)
    {
        return new self($request->all());
    }

    public function handle()
    {
        $user = User::create($this->attributes);

        return $user;
    }
}
