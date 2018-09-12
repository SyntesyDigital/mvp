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
        return $url ? $query->whereHas('urls', function ($q) use ($url) {
            $q->where('url', $url);
        }) : $query;
    }

    public static function findByUrl($url)
    {
        return self::byUrl($url)->first();
    }

    public function getFullSlug($languageId = null)
    {
        // FIXME : cache-it with a key that use updated_at, like md5(content_[id]_fullslug_[updated_at])
        // WARNING : If we use cache we need to think what happen when slug's children change.
        $nodes = self::with('fields')->ancestorsOf($this->id);
        $slug = '';

        foreach ($nodes as $node) {
            $slug = $slug . '/' . $node->getFieldValue('slug', $languageId);
        }

        return $slug . '/' . $this->getFieldValue('slug', $languageId);
    }
}
