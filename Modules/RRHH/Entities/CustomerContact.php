<?php

namespace Modules\RRHH\Entities;

use Illuminate\Database\Eloquent\Model;

class CustomerContact extends Model
{
    const TITLE_MALE = 'M';
    const TITLE_FEMALE = 'F';
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customers_contacts';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'customer_id',
        'title',
        'firstname',
        'lastname',
        'function',
        'service',
        'email',
        'email_2',
        'phone_number_1',
        'phone_number_2',
        'fax',
    ];

    public function customer()
    {
        return $this->belongsTo('Modules\RRHH\Entities\Customer', 'customer_id', 'id');
    }

    public function offers()
    {
        return $this->hasMany('Modules\RRHH\Entities\Offers\Offer');
    }
}
