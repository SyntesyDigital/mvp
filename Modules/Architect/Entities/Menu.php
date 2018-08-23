<?php

namespace Modules\Architect\Entities;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Builder;

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

    public function scopeHasName(Builder $query, $name)
    {
        return $query->where('name', $name);
    }
}
