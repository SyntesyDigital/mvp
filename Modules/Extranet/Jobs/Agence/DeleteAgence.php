<?php

namespace Modules\Extranet\Jobs\Agence;

use Modules\Extranet\Entities\Agence;
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
