<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\BobyRepository;
use Session;

class UnavailableController extends Controller
{
    public function index()
    {
        Session::forget('user');

        return view('unavailable');
    }
}
