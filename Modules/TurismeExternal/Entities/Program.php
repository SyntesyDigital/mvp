<?php

namespace Modules\TurismeExternal\Entities;

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
        return $this->belongsToMany('\Modules\TurismeExternal\Entities\Member', 'members_programs');
    }

    public function category()
    {
        return $this->hasOne('\Modules\TurismeExternal\Entities\Category', 'program_id', 'id');
    }
}
