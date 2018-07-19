<?php

namespace Modules\Turisme\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Turisme\Adapters\PageBuilderAdapter;
use Modules\Architect\Entities\Content;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
      $content = Content::whereField('slug','home')->first();
      $content->load('fields', 'page');

      $pageBuilderAdapter = new PageBuilderAdapter($content);

      if($request->has('debug'))
        dd($pageBuilderAdapter->get());

      return view('turisme::contents.page',[
        'content' => $content,
        'page' => $pageBuilderAdapter->get()
      ]);
    }

    public function show(Request $request, $slug)
    {
      $slug = $request->segment(count($request->segments()));

      $content = Content::whereField('slug', $slug)->first();

      $pageBuilderAdapter = new PageBuilderAdapter($content);

      if($request->has('debug'))
        dd($pageBuilderAdapter->get());


      return view('turisme::contents.page',[
          'content' => $content,
          'page' => $pageBuilderAdapter->get()
      ]);

    }

    public function preview(Request $request,$id)
    {

      $content = Content::find($id);

      $pageBuilderAdapter = new PageBuilderAdapter($content);

      if($request->has('debug'))
        dd($pageBuilderAdapter->get());

      return view('turisme::contents.page',[
        'content' => $content,
        'page' => $pageBuilderAdapter->get()]
      );

    }



}
