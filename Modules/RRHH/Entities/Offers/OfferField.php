<?php

namespace Modules\RRHH\Entities\Offers;

use Illuminate\Database\Eloquent\Model;

class OfferField extends Model
{
    const CONTRACT_TYPE_CDD = 'TYPE_CDD';
    const CONTRACT_TYPE_CDI = 'TYPE_CDI';
    const CONTRACT_TYPE_CDT = 'TYPE_CDT';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'offers_fields';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'offer_id',
        'name',
        'value',
    ];

    public $timestamps = false;

    public function offer()
    {
        return $this->belongsTo('Modules\RRHH\Entities\Offers\Offer');
    }
}
