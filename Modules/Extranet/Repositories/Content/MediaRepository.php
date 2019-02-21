<?php

namespace Modules\Extranet\Repositories\Content;

use Prettus\Repository\Eloquent\BaseRepository;

class MediaRepository extends BaseRepository
{
    public function model()
    {
        return "Modules\\Extranet\\Entities\\Content\Media";
    }
}
