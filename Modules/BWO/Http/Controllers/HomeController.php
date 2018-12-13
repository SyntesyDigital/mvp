<?php

namespace Modules\BWO\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\RRHH\Entities\Offers\Offer;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct() {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        return view('bwo::home', [
          'offers' => Offer::where('status', Offer::STATUS_ACTIVE)->orderBy('created_at', 'desc')->limit(6)->get()
        ]);
    }
}
