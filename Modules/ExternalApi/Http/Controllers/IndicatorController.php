<?php

namespace Modules\ExternalApi\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\ExternalApi\Collections\CompanyCollection;
use Modules\ExternalApi\Collections\IndicatorCollection;
use Modules\ExternalApi\Repositories\IndicatorRepository;

class IndicatorController extends Controller
{

    /**
     * @var AxeRepository
     */
    private $indicators;

    public function __construct(IndicatorRepository $indicators)
    {
        $this->axes = $indicators;
    }

    public function all()
    {
        $indicators = $this->axes
            ->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'))
            ->paginate(20);

        return new IndicatorCollection($indicators);
    }

}
