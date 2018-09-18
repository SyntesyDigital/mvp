<?php

namespace Modules\Architect\Traits;

use Modules\Architect\Entities\Language;
use Illuminate\Database\Eloquent\Builder;
use App;

trait HasUrl
{
    public function urls()
    {
        return $this->morphMany('\Modules\Architect\Entities\Url', 'entity');
    }

    public function getUrlAttribute($language = null)
    {
        $defaultLanguage = $language ? $language : Language::getDefault();
        $defaultLanguageId = isset($defaultLanguage->id) ? $defaultLanguage->id : null;

        $url = $this->urls->where('language_id', $defaultLanguageId)->first();

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
        $slug = $this->getFieldValue('slug', $languageId);

        foreach ($nodes as $node) {
            if($node->getFieldValue('slug', $languageId)) {
                $slug = $node->getFieldValue('slug', $languageId) . '/' . $slug;
            }
        }

        return $slug ? $slug : false;
    }
}
