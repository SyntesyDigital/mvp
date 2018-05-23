<?php

namespace Modules\Architect\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

class MediaRepository extends BaseRepository
{
    public function model()
    {
        return "Modules\\Architect\\Entities\\Media";
    }
}
