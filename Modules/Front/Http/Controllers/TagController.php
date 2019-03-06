<?php

namespace Modules\Front\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Front\Adapters\PageBuilderAdapter;
use Modules\Architect\Entities\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request, $slug)
    {
      $tag = Tag::whereField('slug', $slug)->first();

      if($tag == null){
        abort(404);
      }
      return view('front::tags.page',[
          'tag' => $tag,
      ]);

    }

}
