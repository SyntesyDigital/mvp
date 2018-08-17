<?php

namespace Modules\ExternalApi\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\ExternalApi\Collections\CompanyCollection;
use Modules\ExternalApi\Repositories\IndicatorRepository;

class IndicatorController extends Controller
{

    public function __construct(IndicatorRepository $indicators)
    {
        $this->indicators = $indicators;
    }

    public function companies($id,Request $request)
    {
        $this->indicators->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria')); // Check Request Criteria https://github.com/andersao/l5-repository

        return new CompanyCollection($this->indicators->find($id)->companies()->paginate(20));
    }

}
