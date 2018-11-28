<?php

namespace Modules\RRHH\Entities;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $imagesUpload = ['image'];

    protected $table = 'customers';

    protected $fillable = [
        'name',
        'contact_firstname',
        'contact_lastname',
        'phone',
        'email',
        'address',
        'postal_code',
        'location',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function offers()
    {
        return $this->hasMany('Modules\RRHH\Entities\Offers\Offer');
    }

    public function customers_contacts()
    {
        return $this->hasMany('Modules\RRHH\Entities\CustomerContact');
    }
}
