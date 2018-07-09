<?php

namespace Modules\Turisme\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Architect\Fields\FieldsReactPageBuilderAdapter;
use Modules\Architect\Entities\Content;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('turisme::index');
    }

    public function show(Request $request,$slug)
    {
      $slug = $request->segment(count($request->segments()));

      $content = Content::find(17);

      $pageBuilderAdapter = new FieldsReactPageBuilderAdapter($content);
      //dd($pageBuilderAdapter->get());

      if($request->has('debug'))
        dd($pageBuilderAdapter->get());

      return view('turisme::contents.page',['page' => $pageBuilderAdapter->get()]);

    }

    public function preview(Request $request,$id)
    {

      $content = Content::find($id);

      $pageBuilderAdapter = new FieldsReactPageBuilderAdapter($content);

      if($request->has('debug'))
        dd($pageBuilderAdapter->get());

      return view('turisme::contents.page',['page' => $pageBuilderAdapter->get()]);

    }



}
