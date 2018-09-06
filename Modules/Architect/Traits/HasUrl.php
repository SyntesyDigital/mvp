<?php

namespace Modules\Architect\Traits;

use Illuminate\Database\Eloquent\Builder;
use App;

trait HasUrl
{
    public function urls()
    {
        return $this->morphMany('\Modules\Architect\Entities\Url', 'entity');
    }

    public function getUrlAttribute()
    {
        $url = $this->urls->where('language_id', App::getLocale())->first();

        return $url ? $url->url : false;
    }

    public function scopeByUrl(Builder $query, $url)
    {
        return $url ? $query->whereHas('urls', function($q) use($url) {
            $q->where('url', $url);
        }) : $query;
    }

    public static function findByUrl($url) {
        return self::byUrl($url)->first();
    }
}
