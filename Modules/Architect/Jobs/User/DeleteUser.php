<?php

namespace Modules\Architect\Jobs\User;

use Modules\Architect\Http\Requests\User\DeleteUserRequest;
use App\Models\User;

class DeleteUser
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public static function fromRequest(User $user, DeleteUserRequest $request)
    {
        return new self($user);
    }

    public function handle()
    {
        return $this->user->delete();
    }
}
