<?php

namespace Modules\ExternalApi\Entities;

use Illuminate\Database\Eloquent\Model;

class ProgramCategory extends Model
{
    protected $table = 'programs_categories';

    protected $connection= 'turisme_external';

    protected $fillable = [
        'id',
        'code',
        'program_id',
        'description_ca',
        'description_es',
        'description_en',
    ];

    public $timestamps = false;

    public function members()
    {
        return $this->belongsToMany('\Modules\ExternalApi\Entities\Member', 'members_programs', 'category_id', 'member_id');
    }

    public function program()
    {
        return $this->hasOne('\Modules\ExternalApi\Entities\Program');
    }
}
