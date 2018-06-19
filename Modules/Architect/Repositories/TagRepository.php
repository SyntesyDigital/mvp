<?php

namespace Modules\Architect\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

use Modules\Architect\Entities\Tag;

class TagRepository extends BaseRepository
{
    public function model()
    {
        return "Modules\\Architect\\Entities\\Tag";
    }
}
