<?php
/**
 * Created by PhpStorm.
 * User: ninidc
 * Date: 15/08/2018
 * Time: 14:42
 */

namespace Modules\ExternalApi\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\ExternalApi\Repositories\ProgramCategoryRepository;
use Modules\ExternalApi\Collections\MemberCollection;

class CategoryController extends Controller
{

    /**
     * @var ProgramCategoryRepository
     */
    private $categories;

    public function __construct(ProgramCategoryRepository $categories)
    {
        $this->categories = $categories;
    }


    public function members($code, Request $request)
    {

        // FIXME : user --> $this->members->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria')); // Check Request Criteria https://github.com/andersao/l5-repository

        $category = $this->categories->getByCode($code);

        $collection = $category->members();

        if ($request->get('order')) {
            $order = explode(',', $request->get('order'));
            $column = isset($order[0]) ? $order[0] : null;
            $sens = isset($order[1]) ? $order[1] : null;

            if ($column && $sens) {
                $collection->orderBy($column, $sens);
            }
        }

        return new MemberCollection($collection->paginate(10));
    }
}