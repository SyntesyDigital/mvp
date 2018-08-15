<?php

namespace Modules\TurismeExternal\Entities;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'members';

    protected $connection= 'turisme_external';

    protected $fillable = [
        'id',
        'code',
        'name',
        'address',
        'postcode',
        'city',
        'phone_number',
        'email',
        'web',
        'logo',
    ];

    public $timestamps = false;


    public function programs()
    {
        return $this->belongsToMany('\Modules\TurismeExternal\Entities\Program', 'members_programs');
    }

    public function categories()
    {
        return $this->belongsToMany('\Modules\TurismeExternal\Entities\Category', 'members_programs');
    }

}
