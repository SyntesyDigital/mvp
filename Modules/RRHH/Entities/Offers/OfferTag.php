<?php

namespace Modules\RRHH\Entities\Offers;

use Illuminate\Database\Eloquent\Model;

class OfferTag extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'offers_tags';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'offer_id',
        'tag_offer_id',
    ];

    public $timestamps = false;

    public function offer()
    {
        return $this->belongsTo('Modules\RRHH\Entities\Offers\Offer');
    }
}
