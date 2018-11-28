<?php

namespace Modules\RRHH\Repositories\Content;

use Prettus\Repository\Eloquent\BaseRepository;

class MediaRepository extends BaseRepository
{
    public function model()
    {
        return "App\\Models\\Content\Media";
    }
}
