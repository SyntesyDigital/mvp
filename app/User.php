<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Modules\Architect\Core\RolesPermissions\Traits\HasPermissions;
use Modules\Architect\Core\RolesPermissions\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasPermissions;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'id_per'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
}
