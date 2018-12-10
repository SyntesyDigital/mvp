<?php

namespace Modules\RRHH\Entities;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tags_offers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
    ];

    public $timestamps = false;

    public function candidates()
    {
        return $this->belongsToMany('Modules\RRHH\Entities\Offers\Candidate', 'candidates_tags');
    }

    public function offers()
    {
        return $this->belongsToMany('Modules\RRHH\Entities\Offers\Offer', 'offers_tags');
    }
}
