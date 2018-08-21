<?php
namespace Modules\ExternalApi\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\ExternalApi\Repositories\ProgramCategoryRepository;
use Modules\ExternalApi\Collections\MemberCollection;
use Modules\ExternalApi\Collections\ProgramCategoryCollection;

class ProgramCategoryController extends Controller
{

    /**
     * @var ProgramCategoryRepository
     */
    private $categories;

    public function __construct(ProgramCategoryRepository $programCategories)
    {
        $this->programCategories = $programCategories;
    }

    public function all(Request $request)
    {
        $this->programCategories->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria')); // Check Request Criteria https://github.com/andersao/l5-repository

        return new ProgramCategoryCollection($this->programCategories->paginate(20));
    }

    // public function members($code, Request $request)
    // {
    //     $this->categories->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria')); // Check Request Criteria https://github.com/andersao/l5-repository
    //
    //     // FIXME : user --> $this->members->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria')); // Check Request Criteria https://github.com/andersao/l5-repository
    //
    //     // $category = $this->categories->getByCode($code);
    //     //
    //     // $collection = $category->members();
    //     //
    //     // if ($request->get('order')) {
    //     //     $order = explode(',', $request->get('order'));
    //     //     $column = isset($order[0]) ? $order[0] : null;
    //     //     $sens = isset($order[1]) ? $order[1] : null;
    //     //
    //     //     if ($column && $sens) {
    //     //         $collection->orderBy($column, $sens);
    //     //     }
    //     // }
    //     //
    //     // return new MemberCollection($collection->paginate(10));
    // }
}
