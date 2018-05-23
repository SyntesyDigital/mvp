<?php

namespace Modules\Architect\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Illuminate\Support\Facades\Auth;
use Modules\Architect\Http\Requests\SaveContent;

use App\Models\User;
use App\Models\Role;

class TypologiesController extends Controller
{
    public function index()
    {
        return view('architect::typologies');
    }

    public function show()
    {
      return view('architect::typology');
    }

    public function save(SaveContent $request)
    {

    }
}
