<?php

namespace Modules\RRHH\Entities\Offers;

use Illuminate\Database\Eloquent\Model;

class AlertCandidate extends Model
{
    const STATUS_PENDING = 'PENDING';
    const STATUS_DONE = 'DONE';
    const STATUS_ERROR = 'ERROR';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'alerts_candidates';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'sent_at',
        'offer_id',
        'candidate_id',
    ];

    public $timestamps = false;

    public function candidate()
    {
        return $this->hasOne('Modules\RRHH\Entities\Offers\Candidate', 'id', 'candidate_id');
    }

    public function offer()
    {
        return $this->hasOne('Modules\RRHH\Entities\Offers\Offer', 'id', 'offer_id');
    }
}
