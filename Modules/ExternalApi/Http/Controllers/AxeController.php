<?php

namespace Modules\ExternalApi\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\ExternalApi\Collections\AxeCollection;
use Modules\ExternalApi\Repositories\AxeRepository;

class AxeController extends Controller
{

    /**
     * @var AxeRepository
     */
    private $axes;

    public function __construct(AxeRepository $axes)
    {
        $this->axes = $axes;
    }

    public function all()
    {
        $axes = $this->axes
            ->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'))
            ->paginate(20);

        return new AxeCollection($axes);
    }

}
