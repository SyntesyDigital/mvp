<?php

namespace Modules\ExternalApi\Entities;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = 'programs';

    protected $connection= 'turisme_external';

    protected $fillable = [
        'id',
        'code',
        'description_ca',
        'description_es',
        'description_en',
    ];

    public $timestamps = false;

    public function members()
    {
        return $this->belongsToMany('\Modules\ExternalApi\Entities\Member', 'members_programs');
    }

    public function category()
    {
        return $this->hasOne('\Modules\ExternalApi\Entities\ProgramCategory', 'program_id', 'id');
    }
}
