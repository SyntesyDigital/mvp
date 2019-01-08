<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Modules\Architect\Traits\ImageUpload;
use Zizaco\Entrust\Traits\EntrustUserTrait;

use Acoustep\EntrustGui\Contracts\HashMethodInterface;
use Modules\RRHH\Entities\Offers\Candidate;
use App\Notifications\MailResetPasswordToken;
use Esensi\Model\Contracts\ValidatingModelInterface;
use Esensi\Model\Traits\ValidatingModelTrait;
use Hash;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use SoftDeletes, EntrustUserTrait {
        SoftDeletes::restore insteadof EntrustUserTrait;
        EntrustUserTrait::restore insteadof SoftDeletes;
    }

    use CanResetPassword,
        Notifiable,
        ImageUpload;

    const STATUS_ACTIVE = 'ACTIVE';
    const STATUS_INACTIVE = 'INACTIVE';

    protected $throwValidationExceptions = true;

    protected $table = 'users';

    protected $imagesUpload = [
        'image'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'telephone',
        'image',
        'language',
        'status',
        'linkedin_id'
    ];

    protected $hashable = [
        'password',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
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

    protected $appends = [
        'full_name',
    ];

    public function entrustPasswordHash()
    {
        $this->password = Hash::make($this->password);
        $this->save();
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'role_user', 'user_id', 'role_id');
    }


    // FIXME : Use traits :)
    public function agences()
    {
        return $this->belongsToMany('Modules\RRHH\Entities\Agence', 'agence_user', 'user_id', 'agence_id');
    }

    public function candidate()
    {
        return $this->hasOne('Modules\RRHH\Entities\Offers\Candidate');
    }

    public function customer()
     {
         return $this->belongsToMany('Modules\RRHH\Entities\Customer', 'customers_users', 'user_id', 'customer_id');
     }

    public function offers()
    {
        return $this->hasMany('Modules\RRHH\Entities\Offers\Offer', 'recipient_id', 'id');
    }
    //

    /**
     * Get the user's full name.
     */
    public function getFullNameAttribute()
    {
        return $this->firstname.' '.$this->lastname;
    }

    /*
    *   Return translated status
    */
    public static function getStatus()
    {
        return [
            self::STATUS_ACTIVE => 'Actif',
            self::STATUS_INACTIVE => 'Désactivé',
        ];
    }

    public function getStringStatus()
    {
        return isset($this->getStatus()[$this->status]) ? $this->getStatus()[$this->status] : null;
    }

    public function getRoleId()
    {
        $role = isset($this->roles) ? $this->roles : null;
        $role = $role ? $role->first() : null;

        return $role ? $role->id : null;
    }

    public function getRoleName()
    {
        $role = isset($this->roles) ? $this->roles : null;
        $role = $role ? $role->first() : null;

        return $role ? $role->display_name : null;
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MailResetPasswordToken($token));
    }

    public function is($role)
    {
        if ($role == $this->roles) {
            return true;
        }
        return false;
    }
}
