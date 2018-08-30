<?php

namespace Modules\Turisme\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ContactWithSelection extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'form_contact_selection';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'country',
        'company',
        'comment',
        'privacity',
        'newsletter',
        'conditions',
        'items'
    ];

}
