<?php

namespace Modules\Api\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\Field;

class ContentRepository extends BaseRepository
{
    public function model()
    {
        return Content::class;
    }
}
