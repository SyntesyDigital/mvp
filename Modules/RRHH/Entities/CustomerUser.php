<?php

namespace Modules\RRHH\Entities;

use Illuminate\Database\Eloquent\Model;

class CustomerUser extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customers_users';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'customer_id',
        'user_id',
    ];

    public function customer()
    {
        return $this->belongsTo('Modules\RRHH\Entities\Customer', 'customer_id', 'id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
