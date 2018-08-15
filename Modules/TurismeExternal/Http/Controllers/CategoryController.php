<?php
/**
 * Created by PhpStorm.
 * User: ninidc
 * Date: 15/08/2018
 * Time: 14:42
 */

namespace Modules\TurismeExternal\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\TurismeExternal\Repositories\CategoryRepository;
use Modules\TurismeExternal\Collections\MemberCollection;

class CategoryController extends Controller
{

    /**
     * @var CategoryRepository
     */
    private $categories;

    public function __construct(CategoryRepository $categories)
    {
        $this->categories = $categories;
    }


    public function members($code, Request $request)
    {
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