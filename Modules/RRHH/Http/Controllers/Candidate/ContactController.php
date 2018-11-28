<?php

namespace Modules\RRHH\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use Modules\RRHH\Http\Requests\Front\ContactRequest;
use Modules\RRHH\Jobs\Contact\SendContact;
use Modules\RRHH\Repositories\OfferRepository;
use Auth;
use Illuminate\Http\Request;
use Session;

class ContactController extends Controller
{
    public function __construct(
        OfferRepository $offers
    ) {
        $this->offers = $offers;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('candidate.contact', [
            'related_offers' => $this->offers->getRandomOffers(Auth::user()->candidate->tags()->get()->pluck('id'), 3),
            'active_hex' => 'contact',
        ]);
    }

    public function send(ContactRequest $request)
    {
        if ($sent = $this->dispatch(new SendContact($request->all()))) {
            Session::flash('notify_success', 'Le message a été envoyés correctement');

            return redirect()->action('Candidate\ContactController@index');
        } else {
            Session::flash('notify_error', "Une erreur s'est produite lors de l'envoi de le message");

            return redirect()->action('Candidate\ContactController@index')->withInput();
        }
    }
}
