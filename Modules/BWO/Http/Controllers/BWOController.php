<?php

namespace Modules\BWO\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class BWOController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('bwo::index');
    }

    public function offers()
    {
        return view('bwo::offers');
    }
}
