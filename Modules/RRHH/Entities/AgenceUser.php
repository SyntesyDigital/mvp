<?php

namespace Modules\RRHH\Entities\;

use Illuminate\Database\Eloquent\Model;

class AgenceUser extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'agence_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'agence_id',
        'user_id',
    ];

    public $timestamps = false;

    public function agence()
    {
        return $this->belongsTo('Modules\RRHH\Entities\Agence');
    }
}
