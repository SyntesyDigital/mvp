<?php

namespace Modules\RRHH\Repositories;

use App\Models\Role;
use App\Models\User;
use DB;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Interface UsersRepository.
 */
class UserRepository extends BaseRepository
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return 'App\\Models\User';
    }

    public function getDatatableData()
    {
        return User::with([
            ])->select([
                'users.*',
                DB::raw("CONCAT(users.firstname,' ',users.lastname) as full_name"),
            ]);
    }

    /**
     * Get all users by role(s)
     *  $roles : Array or String.
     *
     *  @return Collection of User
     */
    public function getAllByRoles($roles)
    {
        $roles = ! is_array($roles) ? $roles = [$roles] : $roles;

        return User::whereHas('roles', function ($q) use ($roles) {
            $q->whereIn('name', $roles);
        })->get();
    }
}
