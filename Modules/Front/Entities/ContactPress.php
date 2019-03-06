<?php

namespace Modules\Front\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ContactPress extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'form_press';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'media_type',
        'media_name',
        'media_distribution',
        'media_country',
        'media_web',
        'media_email',
        'media_comment',

        'firstname',
        'lastname',
        'gender',
        'email',
        'country',
        'occupation',
        'web',
        'language',
        'dateStart',
        'dateEnd',
        'comment',
        'delivery',

        'privacity',
        'newsletter',
    ];

}
