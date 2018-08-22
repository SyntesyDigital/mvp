<?php

namespace Modules\Architect\Entities;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Menu extends Model
{
    protected $table = 'menus';

    protected $fillable = [
        'name',
    ];

    public function elements()
    {
        return $this->hasMany('\Modules\Architect\Entities\MenuElement');
    }
}
