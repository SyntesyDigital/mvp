<?php

namespace Modules\Front\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Front\Adapters\PageBuilderAdapter;
use Modules\Front\Adapters\FieldsAdapter;
use Modules\Architect\Entities\Content;
use Modules\Architect\Entities\Url;

use App;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
      $content = Content::whereField('slug','home')->first();

      if($content == null){
        abort(404);
      }

      $content->load('fields', 'page');

      $pageBuilderAdapter = new PageBuilderAdapter($content);

      if($request->has('debug'))
        dd($pageBuilderAdapter->get());

      return view('front::contents.page',[
        'content' => $content,
        'page' => $pageBuilderAdapter->get(),
        'contentSettings' => $content->getSettings()
      ]);
    }

    public function search(Request $request)
    {
      $content = Content::whereField('slug','search')->first();

      if($content == null){
        abort(404);
      }

      $content->load('fields', 'page');

      $pageBuilderAdapter = new PageBuilderAdapter($content);

      if($request->has('debug'))
        dd($pageBuilderAdapter->get());

      return view('front::contents.page',[
        'content' => $content,
        'page' => $pageBuilderAdapter->get(),
        'contentSettings' => $content->getSettings()
      ]);
    }

    private function renderPage($request,$content) {

        $pageBuilderAdapter = new PageBuilderAdapter($content);

        if($request->has('debug'))
          dd($pageBuilderAdapter->get());

        return view('front::contents.page',[
            'content' => $content,
            'page' => $pageBuilderAdapter->get(),
            'contentSettings' => $content->getSettings()
        ]);
    }

    private function renderTypology($request,$content) {

        $data = [
          'content' => $content,
          'fields' => (new FieldsAdapter($content))->get()->toArray(),
          'contentSettings' => $content->getSettings()
        ];

        if($request->has('debug'))
          dd($data);

        return view('front::contents.'.strtolower($content->typology->name),$data);
    }

    public function show(Request $request, $slug)
    {
      //$slug = $request->segment(count($request->segments()));

      $slug = '/'.App::getLocale().'/'.$slug;

      $url = Url::where('url', $slug)
        ->where('entity_type','Modules\Architect\Entities\Content')
        ->first();

      if($url == null){
        abort(404);
      }

      $content = Content::find($url->entity_id);

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

    public function preview(Request $request, $id)
    {

      $content = Content::find($id);

      $pageBuilderAdapter = new PageBuilderAdapter($content);

      if($request->has('debug'))
        dd($pageBuilderAdapter->get());


      if($content->is_page){
         return view('front::contents.page',[
            'content' => $content,
            'page' => $pageBuilderAdapter->get(),
            'contentSettings' => $content->getSettings()
          ]);
      }
      else if(isset($content->typology) && $content->typology->has_slug){
        return $this->renderTypology($request,$content);
      }

      abort(404);

    }

    public function languageNotFound(Request $request)
    {
      abort(404);
    }

}
