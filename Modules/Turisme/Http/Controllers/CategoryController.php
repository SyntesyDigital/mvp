<?php

namespace Modules\Turisme\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Turisme\Adapters\PageBuilderAdapter;
use Modules\Architect\Entities\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request, $slug)
    {
      $category = Category::whereField('slug', $slug)->first();

      if($category == null){
        abort(404);
      }

      return view('turisme::categories.page',[
          'category' => $category,
      ]);

    }

}
