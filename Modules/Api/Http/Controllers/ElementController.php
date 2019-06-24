<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Extranet\Entities\Element;

class ElementController extends Controller
{
    public function index(Request $request)
    {
      $elements= Element::all();
      return $elements->toArray();
    }

}
