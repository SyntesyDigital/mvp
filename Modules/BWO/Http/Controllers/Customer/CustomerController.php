<?php

namespace Modules\BWO\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Session;

use Modules\RRHH\Http\Requests\Front\Customer\UpdateCustomerRequest;
use Modules\RRHH\Jobs\Customer\UpdateFrontCustomer;

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

    public function store(UpdateCustomerRequest $request)
    {

        try {
            $this->dispatchNow(UpdateFrontCustomer::fromRequest(Auth::user(),$request));
            Session::flash('notify_success', 'Enregistrement effectuée avec succès');
        } catch (\Exception $e) {
            Session::flash('notify_error', $e->getMessage());
        }

        return redirect()->route('customer.profile')->with('success','Votre profil vient d\'être mis à jour.');
    }
}
