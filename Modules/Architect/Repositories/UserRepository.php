<?php

namespace Modules\Architect\Repositories;

use App\Role;
use App\User;
use Prettus\Repository\Eloquent\BaseRepository;
use DB;

class UserRepository extends BaseRepository
{
    public function model()
    {
        return 'App\\User';
    }

    public function getDatatableData()
    {
        return User::select([
            'users.*',
            DB::raw("CONCAT(users.firstname,' ',users.lastname) as full_name"),
        ]);
    }

    public function getAllByRoles($roles)
    {
        $roles = ! is_array($roles) ? $roles = [$roles] : $roles;

        return User::whereHas('roles', function ($q) use ($roles) {
            $q->whereIn('name', $roles);
        })->get();
    }
}
