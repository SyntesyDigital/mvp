<?php

namespace Modules\ExternalApi\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\ExternalApi\Collections\AgencyCollection;
use Modules\ExternalApi\Repositories\AgencyRepository;

class AgencyController extends Controller
{
    public function __construct(AgencyRepository $agencies)
    {
        $this->agencies = $agencies;
    }

    public function all()
    {
        $agencies = $this->agencies
            ->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'))
            ->paginate(20);

        return new AgencyCollection($agencies);
    }

}
