<?php

namespace Modules\Turisme\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ContactForm extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'form_contact';

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
        'language',
        'company',
        'company_type',
        'occupation',
        'comment',
        'privacity',
        'newsletter',
        'programs',
        'program_values',
        'init_program',
        'init_program_value',
        'type'
    ];

}
