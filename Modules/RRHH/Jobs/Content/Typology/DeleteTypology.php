<?php

namespace Modules\RRHH\Jobs\Content\Typology;

use Modules\RRHH\Entities\Content\Typology;

class DeleteTypology
{
    public function __construct(Typology $typology)
    {
        $this->typology = $typology;
    }

    public function handle()
    {
        return $this->typology->delete() > 0 ? true : false;
    }
}
