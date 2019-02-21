<?php

namespace Modules\Front\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Extranet\Http\Requests\Front\ContactRequest;
use Modules\Extranet\Jobs\Contact\SendContact;
use Illuminate\Http\Request;
use Session;

class ContactController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('front::contact');
    }

    public function send(ContactRequest $request)
    {
        if ($sent = $this->dispatch(new SendContact($request->all()))) {
            Session::flash('notify_success', 'Votre message vient d\'être envoyé.');

            return redirect()->route('contact.index');
        }

        Session::flash('notify_error', "Une erreur s'est produite lors de l'envoi de le message.");

        return redirect()->route('contact.index')->withInput();
    }
}
