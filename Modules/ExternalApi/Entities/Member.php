<?php

namespace Modules\ExternalApi\Entities;

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
        return $this->belongsToMany('\Modules\ExternalApi\Entities\Program', 'members_programs');
    }

    public function categories()
    {
        return $this->belongsToMany('\Modules\ExternalApi\Entities\ProgramCategory', 'members_programs');
    }

}
