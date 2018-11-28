<?php

namespace Modules\RRHH\Entities;

use Acoustep\EntrustGui\Contracts\HashMethodInterface;
use Modules\RRHH\Entities\Offers\Candidate;
use App\Notifications\MailResetPasswordToken;
use App\Traits\ImageUpload;
use Esensi\Model\Contracts\ValidatingModelInterface;
use Esensi\Model\Traits\ValidatingModelTrait;
use Hash;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract,
    //ValidatingModelInterface,
    HashMethodInterface
{
    use Authenticatable,
        CanResetPassword,
        //ValidatingModelTrait,
        EntrustUserTrait,
        //SoftDeletes,
        Notifiable,
        ImageUpload;

    const STATUS_ACTIVE = 'ACTIVE';
    const STATUS_INACTIVE = 'INACTIVE';

    protected $throwValidationExceptions = true;

    protected $imagesUpload = ['image'];

    protected $table = 'users';

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'telephone',
        'image',
        'password',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $hashable = [
        'password',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
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
        return $this->belongsToMany('Modules\RRHH\Entities\Role', 'roles_users', 'user_id', 'role_id');
    }

    public function agences()
    {
        return $this->belongsToMany('Modules\RRHH\Entities\Agence', 'agence_user', 'user_id', 'agence_id');
    }

    public function candidate()
    {
        return $this->hasOne('Modules\RRHH\Entities\Offers\Candidate');
    }

    public function offers()
    {
        return $this->hasMany('Modules\RRHH\Entities\Offers\Offer', 'recipient_id', 'id');
    }

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
}
