<?php

namespace Modules\Architect\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Auth;
use Modules\Architect\Http\Requests\SaveContent;

class TypologyController extends Controller
{
    public function index()
    {
        return view('architect::typology.index');
    }

    public function create()
    {
        return view('architect::typology.form');
    }
}