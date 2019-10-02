<?php

namespace Modules\Architect\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Modules\Architect\Repositories\StyleRepository;
use Modules\Architect\Jobs\Style\UpdateStyle;

use Modules\Architect\Entities\Style;
use Modules\Architect\Transformers\StyleFormTransformer;

use Auth;
use Session;


class StyleController extends Controller
{
    public function __construct(StyleRepository $styles)
    {
        $this->styles = $styles;
        //$this->middleware('auth');
    }

    public function index()
    {
        return view('architect::styles.index');
    }

    public function show($name)
    {

        $data = [
            'layout' => config('styles.'.$name)
        ];

        $style = Style::where('identifier',$name)->first();

        return view('architect::styles.form',  [
          'layout' =>$data,
          'form' => $style, // object for the update
          'name' => $name,
          'fields' =>  (new StyleFormTransformer($style))->toArray()
        ]);
    }



    public function update(Style $style, Request $request)
    {
        $style = dispatch_now(UpdateStyle::fromRequest($style, $request));

        return $style ? response()->json([
            'success' => true,
            'style' => $style
        ]) : response()->json([
            'success' => false
        ], 500);
    }



    /*public function delete(Style $style, DeleteStyleRequest $request)
    {
        return dispatch_now(DeleteStyle::fromRequest($style, $request)) ? response()->json([
            'success' => true
        ]) : response()->json([
            'success' => false
        ], 500);
    }*/


}
