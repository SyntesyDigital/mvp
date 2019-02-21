<?php

namespace Modules\Architect\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Auth;




class ModelsController extends Controller
{
    public function index()
    {
        return view('architect::models.index');
    }


}
