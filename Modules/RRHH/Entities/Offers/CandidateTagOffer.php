<?php

namespace Modules\RRHH\Entities\Offers;

use Illuminate\Database\Eloquent\Model;

class CandidateTagOffer extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'candidates_tag_offers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'candidate_id',
        'tag_id',
    ];

    public $timestamps = false;
}
