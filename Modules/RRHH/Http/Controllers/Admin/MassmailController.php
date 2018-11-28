<?php

namespace Modules\RRHH\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\RRHH\Http\Requests\Admin\SendMassmailRequest;
use Modules\RRHH\Jobs\SendMassmail;
use Modules\RRHH\Entities\Offers\Candidate;
use Modules\RRHH\Entities\User;
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
        $countNormal = Candidate::whereHas('user', function ($query) {
            $query->where('status', User::STATUS_ACTIVE);
        })
            ->where('type', Candidate::TYPE_NORMAL)
            ->count();

        $countInterim = Candidate::whereHas('user', function ($query) {
            $query->where('status', User::STATUS_ACTIVE);
        })
            ->where('type', Candidate::TYPE_INTERIM)
            ->count();

        return view('admin.massmail', [
            'count_normal' => $countNormal,
            'count_interim' => $countInterim,
        ]);
    }

    public function send(SendMassmailRequest $request)
    {
        if (! $request->get('candidate') && ! $request->get('interim')) {
            Session::flash('notify_error', 'Vous devez choisir au moins un groupe de destinataires');

            return redirect()->action('Admin\MassmailController@index')->withInput();
        } else {
            if ($sent = $this->dispatch(new SendMassmail($request->all()))) {
                Session::flash('notify_success', 'Les emails ont été envoyés correctement');

                return redirect()->action('Admin\MassmailController@index');
            } else {
                Session::flash('notify_error', "Une erreur s'est produite lors de l'envoi d'e-mails");

                return redirect()->action('Admin\MassmailController@index')->withInput();
            }
        }
    }
}
