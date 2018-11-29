<?php

namespace Modules\RRHH\Repositories\Content;

use Prettus\Repository\Eloquent\BaseRepository;

class TypologyRepository extends BaseRepository
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return 'Modules\\RRHH\\Entities\\Content\\Typology';
    }
}
