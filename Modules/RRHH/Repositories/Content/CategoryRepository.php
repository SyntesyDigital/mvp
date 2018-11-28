<?php

namespace Modules\RRHH\Repositories\Content;

use Prettus\Repository\Eloquent\BaseRepository;

class CategoryRepository extends BaseRepository
{
    public function model()
    {
        return "App\\Models\\Content\Category";
    }
}
