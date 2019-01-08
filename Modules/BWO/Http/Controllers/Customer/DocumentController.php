<?php

namespace Modules\BWO\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Session;

class DocumentController extends Controller
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
        return view('bwo::customer.document', [
            'active_hex' => 'documents',
        ]);
    }
}
