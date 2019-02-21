<?php

namespace Modules\Front\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct() {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('front::customer.home');
    }
}
