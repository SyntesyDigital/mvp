<?php

namespace Modules\Architect\Http\Controllers;

use App\Http\Controllers\Controller;

use Modules\Architect\Repositories\MenuRepository;

use App\Models\User;
use Auth;
use Session;

class MenuController extends Controller
{
    public function __construct(MenuRepository $menus)
    {
        $this->menus = $menus;
        $this->middleware('auth');
    }

    public function index()
    {
        return view('architect::menu.index', [
            'menus' => $this->menus->all()
        ]);
    }

    public function elementsTree($id)
    {
        return $this->menus->getElementTree($id);
    }

    public function show($id)
    {
        return view('architect::menu.form', [
            'menu' => $this->menus->find($id)
        ]);
    }

    public function create()
    {
        return view('architect::menu.form');
    }
}
