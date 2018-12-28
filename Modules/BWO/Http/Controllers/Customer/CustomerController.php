<?php

namespace Modules\BWO\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Session;

class CustomerController extends Controller
{
    public function __construct( ) {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('bwo::customer.profile', [
            'active_hex' => 'profile',
        ]);
    }

  /*  public function store(CandidateEditRequest $request)
    {
        try {
            $this->dispatchNow(new UpdateCandidate(Auth::user(), $request->all()));

            return redirect()->route('candidate.profile')->with('success','Votre profil vient d\'être mis à jour.');
        } catch (\Exception $e) {

            return redirect()->route('candidate.profile')->with('error',$e->getMessage());
        }
    }*/
}
