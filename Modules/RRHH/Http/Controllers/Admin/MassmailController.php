<?php

namespace Modules\RRHH\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\RRHH\Http\Requests\Admin\SendMassmailRequest;
use Modules\RRHH\Jobs\SendMassmail;
use Modules\RRHH\Entities\Offers\Candidate;
use App\Models\User;
use Session;

class MassmailController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('rrhh::admin.massmail');
    }

    public function send(SendMassmailRequest $request)
    {
        if ($this->dispatch(new SendMassmail($request->all()))) {
            Session::flash('notify_success', 'Les emails ont été envoyés correctement');
        } else {
            Session::flash('notify_error', "Une erreur s'est produite lors de l'envoi d'e-mails");
        }

        return redirect(route('rrhh.admin.massmail'))->withInput();
    }
}
