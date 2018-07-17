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

      return view('turisme::contents.page',['page' => $pageBuilderAdapter->get()]);
    }

    public function show(Request $request,$slug)
    {
      $slug = $request->segment(count($request->segments()));

      $content = Content::whereField('slug',$slug)->first();

      /*
      $breadcrumb = $content->getBreadCrump();

      $breadcrumb = [
        [
          "id" => 0,
          "fullSlug" => "/"
          "name" => "Home",
        ],
        [
          "id" => 1,
          "fullSlug" => "/trave-trade/"
          "name" => "Travel Trade",
        ],
        [
          "id" => 23,
          "fullSlug" => "/trave-trade/slug-current"
          "name" => "Single Page",
        ],
      ];


          //el cambio de parent_id solo afecta a el mismo y sus hijos, los que estan en otra rama,
          o estan por encima no les afecta,
          //com es el mismo se puede ir propagando el array añadiendo el siguente


          //ejemplo padre = [1,2]
          //hijo 1 = [1,2,3];
          //hijo 2 = [1,2,6];

          home[1] = null
          padre 1 [ [2] => [1]
          padre 2   [3] => [3]
          hijo 1    [4] => [3,2]  //siempre es lo del padre, más el id del padre,
          hijo 2    [5] => [3,2]
                  ]


  //con esto tenemos una estructura de gerarquia siempre actualizada,

//que pasa con el slug ?

  //ahora el slug podemos hacer lo mismo pero ya no necesitamos gerarquia, solo cuando se cambia
  //actualizamos
  [1] = "Home"
  [2] = "Segon son"
  [3] = "Third son"

  Con esto solo vamos a buscar la info para y ya tenemos,
  necesitamos el nombre y el slug no solo el slug, y multidioma,
  [1] => [
    "name" => [
      "ca" => "Home"
      "es" => "Home"
      "en" => "Home"
    ],
    "slug" => [
      "ca" => "single-post"
      "es" => "single-post"
      "en" => etc.
    ]
  ]

  rounte('contents.show',[slug => $content->getFullSlug()])

  /home/slug-1/slug-2/

  cada vez que se guarda el contenido, se mira si ha cambiado el slug o el title, si es así acutalizamos
  cache
      */



      $pageBuilderAdapter = new PageBuilderAdapter($content);
      //dd($pageBuilderAdapter->get());

      if($request->has('debug'))
        dd($pageBuilderAdapter->get());

      return view('turisme::contents.page',['page' => $pageBuilderAdapter->get()]);

    }

    public function preview(Request $request,$id)
    {

      $content = Content::find($id);

      $pageBuilderAdapter = new PageBuilderAdapter($content);

      if($request->has('debug'))
        dd($pageBuilderAdapter->get());

      return view('turisme::contents.page',['page' => $pageBuilderAdapter->get()]);

    }



}
