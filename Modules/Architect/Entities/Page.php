<?php

namespace Modules\Architect\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Architect\Traits\HasFields;

class Page extends Model
{
    use HasFields;

    protected $table = 'pages';

    protected $fillable = [
        'definition'
    ];

    protected $hidden = [
        'deleted_at'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
