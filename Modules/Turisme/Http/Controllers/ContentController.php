<?php

namespace Modules\Turisme\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Turisme\Adapters\PageBuilderAdapter;
use Modules\Turisme\Adapters\FieldsAdapter;
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
        'page' => $pageBuilderAdapter->get(),
        'contentSettings' => $content->getSettings()
      ]);
    }

    private function renderPage($request,$content) {

        $pageBuilderAdapter = new PageBuilderAdapter($content);

        if($request->has('debug'))
          dd($pageBuilderAdapter->get());

        return view('turisme::contents.page',[
            'content' => $content,
            'page' => $pageBuilderAdapter->get(),
            'contentSettings' => $content->getSettings()
        ]);
    }

    private function renderTypology($request,$content) {

        if($request->has('debug'))
          dd($content->toArray());

          // print_r((new FieldsAdapter($content))->get()->get('title')->value);
          // exit();

        return view('turisme::contents.'.strtolower($content->typology->name),[
            'content' => $content,
            'fields' => (new FieldsAdapter($content))->get(),
            'contentSettings' => $content->getSettings()
        ]);
    }

    public function show(Request $request, $slug)
    {
      $slug = $request->segment(count($request->segments()));

      $content = Content::whereField('slug', $slug)->first();

      if($content == null){
        abort(404);
      }

      if($content->is_page){
        return $this->renderPage($request,$content);
      }
      else if(isset($content->typology) && $content->typology->has_slug){
        return $this->renderTypology($request,$content);
      }

      abort(404);
    }

    public function preview(Request $request,$id)
    {

      $content = Content::find($id);

      $pageBuilderAdapter = new PageBuilderAdapter($content);

      if($request->has('debug'))
        dd($pageBuilderAdapter->get());

      return view('turisme::contents.page',[
        'content' => $content,
        'page' => $pageBuilderAdapter->get(),
        'contentSettings' => $content->getSettings()
      ]);

    }



}
