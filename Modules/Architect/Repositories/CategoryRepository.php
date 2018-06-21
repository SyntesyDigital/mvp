<?php

namespace Modules\Architect\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

use Modules\Architect\Entities\Category;

class CategoryRepository extends BaseRepository
{
    public function model()
    {
        return "Modules\\Architect\\Entities\\Category";
    }
}
