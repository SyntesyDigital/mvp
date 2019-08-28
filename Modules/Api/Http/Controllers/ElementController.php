<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Extranet\Entities\Element;
use Modules\Extranet\Entities\RouteParameter;

class ElementController extends Controller
{
    public function index(Request $request)
    {
      $elements= Element::all();
      $elements->load('attrs');
      return $elements->toArray();
    }

    public function parameters(Request $request)
    {
      $parameters = RouteParameter::all();
      return $parameters->toArray();
    }



}
