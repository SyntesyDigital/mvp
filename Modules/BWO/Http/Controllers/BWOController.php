<?php

namespace Modules\BWO\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class BWOController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('bwo::index');
    }

    public function offers()
    {
        return view('bwo::offers');
    }

    public function offer()
    {
        return view('bwo::offer');
    }

    public function blog()
    {
        return view('bwo::blog');
    }

    public function post()
    {
        return view('bwo::post');
    }

    public function candidate()
    {
        return view('bwo::candidate');
    }
    public function candidateForm()
    {
        return view('bwo::candidateform');
    }

    public function customer()
    {
        return view('bwo::customer.home');
    }
    public function customerForm()
    {
        return view('bwo::customer.profile');
    }
}
