<?php

namespace Modules\Extranet\Entities;

use Cache;
use Illuminate\Database\Eloquent\Model;

class ExtranetModel extends Model
{
    //protected $table = 'agences';

    //TODO for @Dani

    protected $fillable = [

    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

}
