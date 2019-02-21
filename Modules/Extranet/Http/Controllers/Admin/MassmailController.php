<?php

namespace Modules\Extranet\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Extranet\Http\Requests\Admin\SendMassmailRequest;
use Modules\Extranet\Jobs\SendMassmail;
use Modules\Extranet\Entities\Offers\Candidate;
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
        return view('extranet::admin.massmail');
    }

    public function send(SendMassmailRequest $request)
    {
        if ($this->dispatch(new SendMassmail($request->all()))) {
            Session::flash('notify_success', 'Les emails ont été envoyés correctement');
        } else {
            Session::flash('notify_error', "Une erreur s'est produite lors de l'envoi d'e-mails");
        }

        return redirect(route('extranet.admin.massmail'))->withInput();
    }
}
