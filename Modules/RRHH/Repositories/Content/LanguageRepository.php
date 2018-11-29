<?php

namespace Modules\RRHH\Repositories\Content;

use Prettus\Repository\Eloquent\BaseRepository;

class LanguageRepository extends BaseRepository
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return 'Modules\\RRHH\\Entities\Language';
    }
}
