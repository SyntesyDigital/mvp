<?php

namespace Modules\RRHH\Jobs\User;

use App\Models\User;

class DeleteUser
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle()
    {
        // If is recruiter account,
        // we give his offers to admin
        if ($this->user->hasRole('recruiter')) {
            $admin = User::whereHas('roles', function ($q) {
                $q->where('name', 'admin');
            })->first();

            if ($admin && $this->user->offers) {
                foreach ($this->user->offers as $offer) {
                    $offer->recipient_id = $admin->id;
                    $offer->update();
                }
            }
        }

        return $this->user->delete() > 0 ? true : false;
    }
}
