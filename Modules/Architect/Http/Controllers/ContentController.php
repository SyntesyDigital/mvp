<?php

namespace Modules\Architect\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Auth;

use Modules\Architect\Entities\Typology;

class ContentController extends Controller
{

    public function __construct() {
    }

    public function index(Request $request)
    {
        // $request->get('typology_id');
        
        return view('architect::contents.index', [
            "typologies" => Typology::all()
        ]);
    }

    public function show( Request $request)
    {
        return view('architect::contents.show');
    }

}
