<?php

namespace Modules\Architect\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Auth;


class ContentController extends Controller
{

    public function __construct() {
    }

    public function index()
    {
        return view('architect::contents.index');
    }

    public function show( Request $request)
    {
        return view('architect::contents.show');
    }

}
