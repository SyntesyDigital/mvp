<?php

namespace Modules\Architect\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class ArchitectController extends Controller
{
    public function index()
    {
        return view('architect::index');
    }
}
