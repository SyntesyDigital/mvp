<?php

namespace Modules\RRHH\Entities;

use Illuminate\Database\Eloquent\Model;

class CustomerField extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customers_fields';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'value',
        'relation',
        'customer_id',
        'parent_id'
    ];

    /**
     * The attributes that are hidden from serialization.
     *
     * @var array
     */
    protected $hidden = [
        'deleted_at'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function customer()
    {
        return $this->belongsTo('\Modules\RRHH\Entities\Customer');
    }
}
