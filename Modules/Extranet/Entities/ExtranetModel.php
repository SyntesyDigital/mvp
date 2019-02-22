<?php

namespace Modules\Extranet\Entities;

use Cache;
use Illuminate\Database\Eloquent\Model;

class ExtranetModel extends Model
{

    protected $table = 'models';

    protected $fillable = [
        'title',
        'icon',
        'config',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

}
