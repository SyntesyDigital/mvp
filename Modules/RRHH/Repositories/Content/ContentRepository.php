<?php

namespace Modules\RRHH\Repositories\Content;

use Modules\RRHH\Entities\Content\Content;
use Modules\RRHH\Entities\Content\Typology;
use Prettus\Repository\Eloquent\BaseRepository;

class ContentRepository extends BaseRepository
{
    public function model()
    {
        return "Modules\\RRHH\\Entities\\Content\Content";
    }

    public function getBlogPosts($category = false, $limit = false, $offset = false)
    {
        $news_typology_id = Typology::where('identifier', 'news')->pluck('id')->first();
        $query = Content::where('status', 1)->where('typology_id', $news_typology_id);
        if ($limit) {
            $query->limit($limit);
        }

        if ($offset) {
            $query->offset($offset);
        }

        return $query->latest()->get();
    }

    public function getBySlug($slug)
    {
        return Content::whereHas('fields', function ($q) use ($slug) {
            $q
                ->where('name', 'slug')
                ->where('value', trim($slug));
        })->first();
    }

    public function getSearchContents($search)
    {
        return Content::whereHas('fields', function ($q) use ($search) {
            $q->where(function ($query) use ($search) {
                $query->where('name', 'title')
                            ->where('value', 'like', '%'.$search.'%');
            })
                   ->orWhere(function ($query) use ($search) {
                       $query->where('name', 'subtitle')
                            ->where('value', 'like', '%'.$search.'%');
                   })
                   ->orWhere(function ($query) use ($search) {
                       $query->where('name', 'excerpt')
                            ->where('value', 'like', '%'.$search.'%');
                   })
                   ->orWhere(function ($query) use ($search) {
                       $query->where('name', 'content')
                            ->where('value', 'like', '%'.$search.'%');
                   });
        })
                ->where('status', 1)
                ->latest()
                ->get();
    }
}
