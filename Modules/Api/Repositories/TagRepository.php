<?php

namespace Modules\Api\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

use Modules\Architect\Entities\Tag;
use Modules\Architect\Entities\Language;
use Modules\Architect\Ressources\TagCollection;

class TagRepository extends BaseRepository
{
    public function model()
    {
        return Tag::class;
    }

    public function fetchAll()
    {
        $tags = Tag::with('contents')
            ->whereHas('contents', function($q) {
                if(request('typology_id')) {
                    $q->where('contents.typology_id', request('typology_id'));
                }
            })
            ->paginate(request('size', 20));

        return new TagCollection($tags);
    }
}
