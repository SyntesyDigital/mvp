<?php

namespace Modules\Extranet\Entities;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'emails_templates';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'identifier',
        'subject',
        'body',
    ];
}
