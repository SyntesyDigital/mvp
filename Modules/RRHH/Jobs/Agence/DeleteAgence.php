<?php

namespace Modules\RRHH\Jobs\Agence;

use Modules\RRHH\Entities\Agence;
use Storage;

class DeleteAgence
{
    public function __construct(Agence $agence)
    {
        $this->agence = $agence;
    }

    public function handle()
    {
        if ('' != $this->agence->image) {
            Storage::delete('public/agences/'.$this->agence->image);
        }

        return $this->agence->delete() > 0 ? true : false;
    }
}
