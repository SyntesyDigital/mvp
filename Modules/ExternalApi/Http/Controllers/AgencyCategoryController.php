<?php

namespace Modules\ExternalApi\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\ExternalApi\Collections\AgencyCategoryCollection;
use Modules\ExternalApi\Entities\AgencyCategory;
use Modules\ExternalApi\Repositories\AgencyCategoryRepository;

class AgencyCategoryController extends Controller
{
    public function __construct(AgencyCategoryRepository $categories)
    {
        $this->categories = $categories;
    }

    public function all()
    {

        $category = AgencyCategory::find(1);


        $categories = $this->categories
            ->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'))
            ->paginate(20);

        return new AgencyCategoryCollection($categories);
    }
}
