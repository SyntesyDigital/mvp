<?php

namespace Modules\ExternalApi\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\ExternalApi\Repositories\CompanyRepository;
use Modules\ExternalApi\Collections\CompanyCollection;

use Modules\ExternalApi\Entities\Axe;
use Modules\ExternalApi\Entities\Company;
use Modules\ExternalApi\Entities\Indicator;


class CompanyController extends Controller
{

    public function __construct(CompanyRepository $companies)
    {
        $this->companies = $companies;
    }

    public function all()
    {
        $this->companies->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));

        return new CompanyCollection($this->companies->paginate(6));
    }
}
