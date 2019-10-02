<?php

namespace Modules\Architect\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;

use Modules\Architect\Entities\Style;
use Lang;

class StyleRepository extends BaseRepository
{
    public function model()
    {
        return "Modules\\Architect\\Entities\\Style";
    }

  
}
