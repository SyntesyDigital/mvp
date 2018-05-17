<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Modules\Architect\Traits\ImageUpload;

class User extends Authenticatable
{
    use Notifiable;
    use ImageUpload;

    protected $table = 'users';

    protected $imagesUpload = ['image'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function is($role) {
        if($role == $this->roles) {
            return true;
        }
        return false;
    }
}
